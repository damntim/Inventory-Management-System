<?php
class Stockin {
    private $conn;
    private $table_name = "stockin";

    public $stock_id;
    public $product_id;
    public $quantity;
    public $partner_id;
    public $amount;
    public $netprice;
    public $taxrate;
    public $discount;
    public $totalprice;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch price details based on product ID and supplier ID
    public function fetchPriceDetails($product_id, $partner_id) {
        $query = "
            SELECT 
                *
            FROM 
                prices
            WHERE 
                ProductID = :product_id 
                AND paternerID = :partner_id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':partner_id', $partner_id);
        
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row;
            }
        }
        return false;
    }

    public function create() {
        $query = "
            INSERT INTO " . $this->table_name . " 
            (product_id, quantity, partner_id, amount, netprice, taxrate, discount, totalprice)
            VALUES
            (:product_id, :quantity, :partner_id, :amount, :netprice, :taxrate, :discount, :totalprice)
        ";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':partner_id', $this->partner_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':netprice', $this->netprice);
        $stmt->bindParam(':taxrate', $this->taxrate);
        $stmt->bindParam(':discount', $this->discount);
        $stmt->bindParam(':totalprice', $this->totalprice);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readAll() {
        $query = "
            SELECT s.stock_id, s.product_id, s.created_at, p.product_name, s.quantity, s.partner_id, sup.fullname, sup.email, s.amount, s.netprice, s.taxrate, s.discount, s.totalprice 
            FROM " . $this->table_name . " s
            JOIN products_tab p ON s.product_id = p.product_id
            JOIN supplier sup ON s.partner_id = sup.id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE stock_id = :stock_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':stock_id', $this->stock_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
?>
