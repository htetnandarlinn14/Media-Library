<?php

namespace App\Service;

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $ruleSet) {
            $value = trim($data[$field] ?? '');

            /*
             * |--------------------------------------------------------------------------
             * | REQUIRED
             * |--------------------------------------------------------------------------
             */

            if (($ruleSet['required'] ?? false) && empty($value)) {
                $this->errors[$field] = ucfirst($field) . ' is required';

                continue;
            }

            /*
             * |--------------------------------------------------------------------------
             * | MIN LENGTH
             * |--------------------------------------------------------------------------
             */

            if (isset($ruleSet['min']) && strlen($value) < $ruleSet['min']) {
                $this->errors[$field] =
                    ucfirst($field) . " must be at least {$ruleSet['min']} characters";
            }

            /*
             * |--------------------------------------------------------------------------
             * | MAX LENGTH
             * |--------------------------------------------------------------------------
             */

            if (isset($ruleSet['max']) && strlen($value) > $ruleSet['max']) {
                $this->errors[$field] =
                    ucfirst($field) . " must not exceed {$ruleSet['max']} characters";
            }

            /*
             * |--------------------------------------------------------------------------
             * | EMAIL
             * |--------------------------------------------------------------------------
             */

            if (($ruleSet['email'] ?? false) &&
                    !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->errors[$field] =
                    ucfirst($field) . ' must be a valid email';
            }

            /*
             * |--------------------------------------------------------------------------
             * | MATCH PASSWORD
             * |--------------------------------------------------------------------------
             */

            if (isset($ruleSet['match'])) {
                $matchField = $ruleSet['match'];

                if ($value !== ($data[$matchField] ?? '')) {
                    $this->errors[$field] =
                        ucfirst($field) . ' does not match';
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
