<?php

namespace Tests\Feature;

use App\Categoria;
use App\Producto;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    function test_get_productos()
    {
        $this->withoutExceptionHandling();

        factory(Categoria::class, 3)->create();
        factory(Producto::class, 2)->create();
        $key ="key_cur_prod_fnPqT5xQEi5Vcb9wKwbCf65c3BjVGyBBAAAX";
        $response = $this->get('/api/apiProductos?api_key=' . $key);

        $response->assertOk();
        $response->assertStatus(200);
        return $response;
        
    }
}
