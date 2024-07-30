-- Product Requisition Report
SELECT
    r.id AS request_id,
    r.withdrawal_date,
    r.employee_name AS employee,
    p.name AS product,
    ri.quantity
FROM requests r
         JOIN request_items ri ON r.id = ri.request_id
         JOIN products p ON ri.product_id = p.id
WHERE r.withdrawal_date BETWEEN '2009-11-10' AND '2009-12-10'
ORDER BY r.withdrawal_date, r.id;

