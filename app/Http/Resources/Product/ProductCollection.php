<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //transforming data yang bakal diliat user tentang product secara keseluruhan
        return [
            'name'=>$this->name,
            'totalPrice'=>round((1-($this->discount/100)) * $this->price,2),
            'rating'=> $this->reviews->count() > 0 ?  //cek apakah ada rating pada product yang ditunjuk, kalau ada ubah hitungan ratingnya, kalau ga ada tampilkan 'No Rating yet'
                    round($this->reviews->sum('star')/
                    $this->reviews->count())
                    : 'No Rating yet!',
            'discount' =>$this->discount,
            'href'=>[
                'link'=>route('products.show', $this->id)
            ]
        ];
    }
}
