<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        //transforming data yang akan dilihat user tentang  product secara spesifik ../api/products/{id product}
        return [
            'name'=>$this->name,
            'description'=>$this->detail,
            'price'=>$this->price,
            'stock'=>$this->stock == 0 ? 'Out of stock!' : $this->stock,
            'discount'=>$this->discount,
            'totalPrice'=>round((1-($this->discount/100)) * $this->price,2),
            'rating'=> $this->reviews->count() > 0 ?  //cek apakah ada rating pada product yang ditunjuk, kalau ada ubah hitungan ratingnya, kalau ga ada tampilkan 'No Rating yet'
                    round($this->reviews->sum('star')/
                    $this->reviews->count())
                    : 'No Rating yet!',
            'href'=>[
                'reviews'=>route('reviews.index',$this->id) 
                ]

        ];
    }
}
