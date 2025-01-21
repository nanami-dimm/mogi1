<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Exhibition;
use App\seeders\ProductsTableSeeder;


class MogiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
     /**
     * Test the registration form validation.
     *
     * @dataProvider dataprovider
     */
    public function test_register(array $keys,array $values, bool $expect): void
    {
       $dataList =array_combine($keys,$values);

       $rules = [
        'name' => 'required',
            'email' => 'required',
            'password' => 'required| min:8|confirmed',
       ];

       $request = new RegisterRequest();

       $validator = Validator::make($dataList,$rules);

       $result = $validator->passes();

       $this->assertEquals($expect,$result);

       
    }

    public function test_logout()
{
    // ユーザーを認証状態にする
    $user = User::factory()->create();
    $this->actingAs($user);

    // ログイン状態を確認
    $this->assertAuthenticated();

    // ログアウト処理を実行
    $response = $this->post('/logout');

    // リダイレクトを確認
    $response->assertStatus(302);
    $response->assertRedirect('/');

    // ログアウト後、ユーザーが認証されていないことを確認
    $this->assertGuest();
}

public function test_exhibition()
    {
        $this->seed(ProductsTableSeeder::class);

        Exhibition::create([
            'product_name' => '椅子',
            'product_description' => '木で作られた椅子',
            'product_image' => 'storage/images/chair.jpg',
            'product_price' => '1000',
            'productcondition_id' => '1',
        ]);
        
        $this->assertDatabaseHas('exhibitions',[
            'product_name' => '椅子',
            'product_description' => '木で作られた椅子',
            'product_image' => 'storage/images/chair.jpg',
            'product_price' => '1000',
            'productcondition_id' => '1',
        ]);
    }


    /**public function test_successregister(): void {
        $data = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => '11111111',
            
        ];

        $response = $this->post(route('register'),$data);

        $response->assertRedirect(route('mypage.profile'));

        $this->assertDatabasehas(User::class, $data);
    }**/

    public function dataprovider(): array{
        return [
            'ユーザー名が必須エラー' => [
                ['name','email','password'],[null,'test@example.com','11111111'],false
            ],
            'メールアドレスが必須エラー' => [
               ['name','email','password'],['test',null,'11111111'],false
            ],
            'パスワードが必須エラー' => [
               ['name','email','password'],['test','test@example.com',null],false
            ],
            'パスワードが７文字以下エラー' => [
                 ['name','email','password'],['test','test@example.com',str_repeat('1',7),],false
            ],
        ];
    }

    

    
}
