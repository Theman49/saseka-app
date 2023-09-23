<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;
    

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kategori = array("musik", "rupa", "sastra");
        $typeFile = array("jpg", "png", "mp4", "pdf");
        $getKategori = $kategori[mt_rand(0,2)];
        $karyaVideo = "file-karya/musik/MGFrBPSnqBQleHB3Fc0MgNMUtGMrhRTiL2OzCmu0.mp4";
        $coverImage = "file-cover/xyyzs5BeMwTA0ZAnETXnVRUAJSCGssD48MfXHaDj.png";
        $karyaPdf = "file-karya/sastra/cxVpzbIRIiTuqKjz8IBeWOhAmgIC9iYUHdCpnmV5.pdf";


        if($getKategori == "sastra"){
            $getTypeFile = $typeFile[3];
            $getKarya = $karyaPdf;
        }else if($getKategori == "musik"){
            $getTypeFile = $typeFile[2];
            $getKarya = $karyaVideo;
        }else if($getKategori == "rupa"){
            $getTypeFile = $typeFile[mt_rand(0,2)];
            if($getTypeFile == "mp4"){
                $getKarya = $karyaVideo;
            }else{
                $getKarya = $coverImage;
            }
        }
        return [
            'judul' =>  $this->faker->name(),
            'slug' => $this->faker->slug(),
            'path_file' => $getKarya,
            'type_file' => $getTypeFile,
            'cover_image' => $coverImage,
            'karya_dari' => "",
            'kategori' => $getKategori,
            'deskripsi' => $this->faker->paragraph(mt_rand(10, 25))
        ];
    }
}
