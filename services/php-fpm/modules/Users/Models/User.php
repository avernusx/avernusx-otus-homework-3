<?php

namespace Modules\Users\Models;

use \Datetime;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\Schema()
 * @Entity
 * @Table(name="users")
 */
class User
{
    /**
     * UUID
     * @var string | null
     * @OA\Property()
     * @Column(type="guid")
     * @Id
     * @GeneratedValue(strategy="UUID")
     */
    public ?string $id;

    /**
     * Логин
     * @var string
     * @OA\Property()
     * @Column(type="string")
     * @Assert\NotBlank
     */
    public string $login;

    /**
     * Электронная почта
     * @var string
     * @OA\Property()
     * @Column(type="string")
     * @Assert\NotBlank
     */
    public string $email;

    /**
     * Хеш пароля
     * @var string
     * @Column(type="string")
     */
    public string $password;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}