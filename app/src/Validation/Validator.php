<?php

namespace Market\Validation;

use Exception;
use Market\Models\User;
use Violin\Violin as V;
use Market\Helpers\Hash;
use Market\Models\Category;
use Market\Models\Supplier;

class Validator extends V
{
    protected $user;

    protected $hash;

    protected $auth;

    public function __construct(User $user, Hash $hash, $auth = null)
    {
        $this->user = $user;
        $this->hash = $hash;
        $this->auth = $auth;

        $this->addFieldMessages([
            'email' => [
                'createEmail' => '邮箱已经存在'
            ],
            'username' => [
                'uniqueUsername' => '用户名已经存在'
            ],
            'title' => [
                'createTitle' => '分类名称已经存在',
                'updateTitle' => '分类名称已经存在'
            ],
            'brand' => [
                'createBrand' => '厂商已经存在',
                'updateBrand' => '厂商已经存在'
            ]
        ]);

        $this->addRuleMessages([
            'matchesCurrentPassword' => '输入密码和当前密码不匹配',
            'existCategory' => '该分类不存在',
            'existSupplier' => '该供应商未添加'
        ]);
    }

    public function validate_existCategory($value, $input, $args)
    {
        try {
            Category::findOrFail($value);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function validate_existSupplier($value, $input, $args)
    {
        try {
            Supplier::findOrFail($value);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function validate_createBrand($value, $input, $args)
    {
        $s = Supplier::whereBrand($value);

        return ! (bool) $s->count();
    }

    public function validate_updateBrand($value, $input, $args)
    {
        $s = Supplier::whereBrand($value);

        if ($s->first()->id == $input['id']) return true;

        return ! (bool) $s->count();
    }

    public function validate_createTitle($value, $input, $args)
    {
        $c = Category::whereTitle($value);

        return ! (bool) $c->count();
    }

    public function validate_updateTitle($value, $input, $args)
    {
        $c = Category::whereTitle($value);

        if ($c->first()->id == $input['id']) return true;

        return ! (bool) $c->count();
    }

    public function validate_createEmail($value, $input, $args)
    {
        $user = $this->user->whereEmail($value);

        return ! (bool) $user->count();
    }

    public function validate_uniqueUsername($value, $input, $args)
    {
        $user = $this->user->whereUsername($value);

        return ! (bool) $user->count();
    }

    public function validate_matchesCurrentPassword($value, $input, $args)
    {
        return $this->hash->check($value, $this->auth->password);
    }

    public function validate_notEquals($value, $input, $args)
    {
        return $value !== $input[$args[0]];
    }
}
