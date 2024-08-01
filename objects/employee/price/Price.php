<?php
class Price {
    private $conn;
    private $table_name = "prices";

    public $id;
    public $productID;
    public $amount;
    public $paternerID;
    public $pricetype;
    public $netprice;
    public $taxrate;
    public $discount;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addPrice() {
        // Calculate net price
        $this->netprice = $this->calculateNetPrice($this->amount, $this->taxrate, $this->discount);

        $query = "INSERT INTO " . $this->table_name . " (productID, amount, paternerID, pricetype, netprice, taxrate, discount) VALUES (:productID, :amount, :paternerID, :pricetype, :netprice, :taxrate, :discount)";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->productID = htmlspecialchars(strip_tags($this->productID));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->paternerID = htmlspecialchars(strip_tags($this->paternerID));
        $this->pricetype = htmlspecialchars(strip_tags($this->pricetype));
        $this->taxrate = htmlspecialchars(strip_tags($this->taxrate));
        $this->discount = htmlspecialchars(strip_tags($this->discount));

        // bind values
        $stmt->bindParam(":productID", $this->productID);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":paternerID", $this->paternerID);
        $stmt->bindParam(":pricetype", $this->pricetype);
        $stmt->bindParam(":netprice", $this->netprice);
        $stmt->bindParam(":taxrate", $this->taxrate);
        $stmt->bindParam(":discount", $this->discount);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private function calculateNetPrice($amount, $taxrate, $discount) {
        $taxAmount = ($amount * $taxrate) / 100;
        $discountAmount = ($amount * $discount) / 100;
        return $amount + $taxAmount - $discountAmount;
    }
}
?>
