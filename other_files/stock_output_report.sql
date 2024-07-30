-- Stock Output Report
SELECT
    p.name AS product,
    COALESCE(SUM(ri.quantity), 0) AS quantity_withdrawn,
    COALESCE(SUM(ri.quantity * p.cost_price), 0) AS total_cost_price
FROM request_items ri
JOIN requests r ON ri.request_id = r.id
JOIN products p ON ri.product_id = p.id
WHERE r.withdrawal_date BETWEEN '2009-11-10' AND '2009-12-10'
AND p.type = 'simple'
GROUP BY p.id, p.name

-- Adding component outputs of composite products

SELECT
    p.name AS product,
    COALESCE(SUM(ri.quantity * pcc.quantity), 0) AS quantity_withdrawn,
    COALESCE(SUM(ri.quantity * pcc.quantity * p.cost_price), 0) AS total_cost_price
FROM request_items ri
JOIN requests r ON ri.request_id = r.id
JOIN product_composed_components pcc ON ri.product_id = pcc.product_composed_id
JOIN products p ON pcc.product_simple_id = p.id
WHERE r.withdrawal_date BETWEEN '2024-01-01' AND '2024-12-31'
GROUP BY p.id, p.name;
