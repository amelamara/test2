<?php
namespace App\Tests\Entity;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
class ProductTest extends TestCase{
	public function testDefault(){
        $product = new Product('Pomme', 'food', 1);
        $this->assertSame(0.055, $product->computeTVA());
    }

    public function testComputeTVAOtherProduct()
    {
        $product = new Product('Un autre produit', 'Un autre type de produit', 20);
        $this->assertSame(3.92, $product->computeTVA());
    }

    public function testNegativePriceComputeTVA(){
		$product = new Product('Un produit', 'food', -20);
		$this->expectException('Exception');
		$product->computeTVA();
	}

	/**
   * @dataProvider pricesForFoodProduct
   */
    public function testcomputeTVAFoodProduct($price, $expectedTva){
              $product = new Product('Un produit', Product::FOOD_PRODUCT, $price);
              $this->assertSame($expectedTva, $product->computeTVA());
    }
    public function pricesForFoodProduct(){
      	return [[0, 0.0],[20, 1.1],[100, 5.5]];
    }

}
?>
