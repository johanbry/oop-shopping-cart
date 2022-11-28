<?php


class Cart
{
    private array $items = [];

    //TODO Skriv getter för items
    public function getItems()
    {
        return $this->items;
    }

    /*
     Skall lägga till en produkt i kundvagnen genom att
     skapa ett nytt cartItem och lägga till i $items array.
     Metoden skall returnera detta cartItem.

     VG: Om produkten redan finns i kundvagnen
     skall istället quantity på cartitem ökas.
     */
    public function addProduct($product, $quantity)
    {
        $cartItem = new CartItem($product, $quantity);
        $this->items[] = $cartItem;
        return $cartItem;
    }


    //Skall ta bort en produkt ur kundvagnen (använd unset())
    public function removeProduct($product)
    {
        for($i=0; $i<count($this->items); $i++)
        {
            if ($product->getId() === $this->items[$i]->getProduct()->getId())
            {
                unset($this->items[$i]);
                $this->items = array_values($this->items); // Reindex the array after unset
                //array_splice($this->items, $i, 1);
                break;
            }
        }

        
        // $index = 0;

        // foreach ($this->items as $item) {
        //     if ($product->getId() === $item->getProduct()->getId())
        //     {
        //         echo "Remove: " . $product->getTitle();
        //         unset($this->items[$index]);
        //     }
        //     $index++;
        // }
    }

    //Skall returnera totala antalet produkter i kundvagnen
    //OBS: Ej antalet unika produkter
    public function getTotalQuantity()
    {
        $qty = 0;
        foreach ($this->items as $item) {
            $qty += $item->getQuantity();
        }
        return $qty;
    }

    //Skall räkna ihop totalsumman för alla produkter i kundvagnen
    //VG: Tänk på att ett cartitem kan ha olika quantity
    public function getTotalSum()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getQuantity() * $item->getProduct()->getPrice();
        }
        return $sum; 
    }
}
