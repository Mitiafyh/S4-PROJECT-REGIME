<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'Settings';
    protected $primaryKey = 'key';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $allowedFields = ['key', 'value'];

    public function getValue(string $key, $default = null)
    {
        $row = $this->find($key);
        if (!$row || !array_key_exists('value', $row)) {
            return $default;
        }

        return $row['value'];
    }

    public function setValue(string $key, $value): bool
    {
        $data = [
            'key' => $key,
            'value' => (string) $value,
        ];

        if ($this->find($key)) {
            return (bool) $this->update($key, $data);
        }

        return (bool) $this->insert($data);
    }
}
