<?php

use Market\Models\Goods;
use Market\Helpers\Filer;
use Market\Models\Category;
use Market\Models\Supplier;

$app->get('/admin/goods/create', function ($request, $response, $args) use ($app) {
    $categories = Category::lists('title', 'id');
    $suppliers = Supplier::lists('brand', 'id');

    return $this->view->render($response, 'admin/goods/create.html', [
        'cateName' => '商品管理',
        'categories' => $categories,
        'suppliers' => $suppliers,
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($authenticated)->setName('admin.goods.create');

$app->post('/admin/goods/store', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();
    $name = $request->getParam('name');
    $amount = $request->getParam('amount');
    $price = $request->getParam('price');
    $category_id = $request->getParam('category_id');
    $supplier_id = $request->getParam('supplier_id');

    $v = $c->validator;
    $v->validate([
        'name' => [$name, 'required'],
        'amount' => [$amount, 'required|int'],
        'price' => [$price, 'required|number'],
        'category_id' => [$category_id, 'required|int|existCategory'],
        'supplier_id' => [$supplier_id, 'required|int|existSupplier'],
    ]);

    if ($v->passes()) {
        $image = $_FILES['image'];
        if ($image['name']) {
            move_uploaded_file($image['tmp_name'], 'img/goods/' . $image['name']);
            $imageName = 'goods/' . $image['name'];
        } else {
            $imageName = 'goods/default.png';
        }

        Goods::create([
            'name' => $name,
            'amount' => $amount,
            'price' => $price,
            'category_id' => $category_id,
            'supplier_id' => $supplier_id,
            'image' => $imageName
        ]);

        $filer = new Filer('storage/log-goods.txt');
        $filer->write(sprintf("<b>%s</b>(%s) 在 %s: 添加 <i>%d</i> 份 %s\n", $this->auth->username, $this->auth->email, date('Y-m-d H:i:s'), $amount, $name));

        $c->flash->addMessage('message_admin', '成功添加' . $name);
        return $response->withRedirect($c->router->pathFor('admin.goods'));
    }

    $c->flash->addMessage('error_admin', '请确认后填写');
    return $response->withRedirect($c->router->pathFor('admin.goods.create'));

})->add($authenticated)->setName('admin.goods.store');
