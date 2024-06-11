<?php
class Product {
    private $name;
    private $price;
    private $quantity;

    public function __construct($name, $price, $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function __toString() {
        return "Produkt: " . $this->name . ", Cena: " . $this->price . ", Ilość: " . $this->quantity;
    }
}

class Cart {
    private $products = [];

    public function __construct() {
        $this->products = [];
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function removeProduct(Product $product) {
        foreach ($this->products as $key => $value) {
            if ($value === $product) {
                unset($this->products[$key]);
            }
        }
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }

    public function __toString() {
        $output = "Produkty w koszyku:\n";
        foreach ($this->products as $product) {
            $output .= $product . "\n";
        }
        $output .= "Końcowa cena: " . $this->getTotal();
        return $output;
    }
}

//Przykłąd działania
$laptop = new Product("Laptop", 1500, 1);
$phone = new Product("Phone", 800, 2);

$cart = new Cart();

$cart->addProduct($laptop);
$cart->addProduct($phone);

//Usuwanie produktu dlatego sie nie wyświetla :)
$cart->removeProduct($phone);

echo $cart;
?>