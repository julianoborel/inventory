-- Stock Entry Report
SELECT
    p.name AS product,
    COALESCE(SUM(ri.quantity), 0) AS quantity_requested,
    COALESCE(SUM(ri.quantity * p.cost_price), 0) AS total_cost_price,
    COALESCE(SUM(ri.quantity * p.sale_price), 0) AS total_sale_price
FROM request_items ri
JOIN requests r ON ri.request_id = r.id
JOIN products p ON ri.product_id = p.id
WHERE r.withdrawal_date BETWEEN '2024-01-01' AND '2024-12-31'
GROUP BY p.id, p.name

UNION ALL

-- Adding component entries for composite products
SELECT
    p.name AS product,
    COALESCE(SUM(ri.quantity * JSON_UNQUOTE(JSON_EXTRACT(p.components, CONCAT('$[', idx, '].quantity')))), 0) AS quantity_requested,
    COALESCE(SUM(ri.quantity * JSON_UNQUOTE(JSON_EXTRACT(p.components, CONCAT('$[', idx, '].quantity'))) * p.cost_price), 0) AS total_cost_price,
    COALESCE(SUM(ri.quantity * JSON_UNQUOTE(JSON_EXTRACT(p.components, CONCAT('$[', idx, '].quantity'))) * p.sale_price), 0) AS total_sale_price
FROM request_items ri
         JOIN requests r ON ri.request_id = r.id
         JOIN products p ON ri.product_id = p.id
         JOIN JSON_TABLE(p.components, '$[*]' COLUMNS (
    idx FOR ORDINALITY,
    quantity INT PATH '$.quantity'
)) AS jt ON jt.idx = JSON_UNQUOTE(JSON_EXTRACT(p.components, CONCAT('$[', jt.idx - 1, '].quantity')))
WHERE r.withdrawal_date BETWEEN '2024-01-01' AND '2024-12-31'
  AND p.type = 'composed'
GROUP BY p.id, p.name;
