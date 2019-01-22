<?php
/**
 * Created by PhpStorm.
 * User: lihq
 * Date: 2019/1/22
 * Time: 16:44
 */

/**
 * 依赖注入
 * 对象实例通过方法参数定义就能传递进来，调用的时候不需要我们自己去手动传入
 */

// routes/web.php
Route::get('/post/store', 'PostController@store');

// App\Http\Controllers
class PostController extends Controller {

    public function store(Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:255|min:4',
            'body' => 'required|min:6',
        ]);
    }

}