<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\ValidationTrait;
use stdClass;

class ValidationTraitTest extends TestCase
{
    use ValidationTrait;

    /* Validate Required Tests */
    public function testValidateRequiredWithEmptyString(): void
    {
        $result = self::validateRequired('');
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithWhitespaceString(): void
    {
        $result = self::validateRequired('   ');
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithNull(): void
    {
        $result = self::validateRequired(null);
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithZero(): void
    {
        $result = self::validateRequired(0);
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithNonEmptyString(): void
    {
        $result = self::validateRequired('Hello');
        $this->assertTrue($result);
    }

    public function testValidateRequiredWithArray(): void
    {
        $result = self::validateRequired(['item1', 'item2']);
        $this->assertTrue($result);
    }

    public function testValidateRequiredWithObject(): void
    {
        $result = self::validateRequired(new stdClass());
        $this->assertTrue($result);
    }

    /* Validate Email Tests */
    public function testValidateEmailWithValidEmail(): void
    {
        $validEmail = 'user@example.com';
        $result = self::validateEmail($validEmail);
        $this->assertTrue($result);
    }

    public function testValidateEmailWithInvalidEmail(): void
    {
        $invalidEmail = 'invalid-email';
        $result = self::validateEmail($invalidEmail);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithEmptyValue(): void
    {
        $emptyEmail = '';
        $result = self::validateEmail($emptyEmail);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithNullValue(): void
    {
        $nullEmail = null;
        $result = self::validateEmail($nullEmail);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithArray(): void
    {
        $emailArray = ['user@example.com'];
        $result = self::validateEmail($emailArray);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithObject(): void
    {
        $emailObject = (object)['email' => 'user@example.com'];
        $result = self::validateEmail($emailObject);
        $this->assertFalse($result);
    }

    /* Validate Numeric Tests */
    public function testValidateNumericWithValidNumeric(): void
    {
        $validNumeric = 123;
        $result = self::validateNumeric($validNumeric);
        $this->assertTrue($result);
    }

    public function testValidateNumericWithInvalidNumeric(): void
    {
        $invalidNumeric = 'abc';
        $result = self::validateNumeric($invalidNumeric);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithEmptyValue(): void
    {
        $emptyValue = '';
        $result = self::validateNumeric($emptyValue);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithNullValue(): void
    {
        $nullValue = null;
        $result = self::validateNumeric($nullValue);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithArray(): void
    {
        $numericArray = [123];
        $result = self::validateNumeric($numericArray);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithObject(): void
    {
        $numericObject = (object)['value' => 123];
        $result = self::validateNumeric($numericObject);
        $this->assertFalse($result);
    }

    /* Validate Integer Tests */
    public function testValidateIntegerWithValidInteger(): void
    {
        $validInteger = 123;
        $result = self::validateInteger($validInteger);
        $this->assertTrue($result);
    }

    public function testValidateIntegerWithInvalidInteger(): void
    {
        $invalidInteger = 'abc';
        $result = self::validateInteger($invalidInteger);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithEmptyValue(): void
    {
        $emptyValue = '';
        $result = self::validateInteger($emptyValue);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithNullValue(): void
    {
        $nullValue = null;
        $result = self::validateInteger($nullValue);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithArray(): void
    {
        $integerArray = [123];
        $result = self::validateInteger($integerArray);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithObject(): void
    {
        $integerObject = (object)['value' => 123];
        $result = self::validateInteger($integerObject);
        $this->assertFalse($result);
    }

    /* Validate Float Tests */
    public function testValidateFloatWithValidFloat(): void
    {
        $validFloat = 123.45;
        $result = self::validateFloat($validFloat);
        $this->assertTrue($result);
    }

    public function testValidateFloatWithInvalidFloat(): void
    {
        $invalidFloat = 'abc';
        $result = self::validateFloat($invalidFloat);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithEmptyValue(): void
    {
        $emptyValue = '';
        $result = self::validateFloat($emptyValue);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithNullValue(): void
    {
        $nullValue = null;
        $result = self::validateFloat($nullValue);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithArray(): void
    {
        $floatArray = [123.45];
        $result = self::validateFloat($floatArray);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithObject(): void
    {
        $floatObject = (object)['value' => 123.45];
        $result = self::validateFloat($floatObject);
        $this->assertFalse($result);
    }

    /* Validate Max Length Tests */
    public function testValidateMaxLengthWithShorterValue(): void
    {
        $value = 'short';
        $maxLength = 10;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    public function testValidateMaxLengthWithEqualValue(): void
    {
        $value = 'equal';
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    public function testValidateMaxLengthWithLongerValue(): void
    {
        $value = 'toolong';
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertFalse($result);
    }

    public function testValidateMaxLengthWithEmptyValue(): void
    {
        $value = '';
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    public function testValidateMaxLengthWithNullValue(): void
    {
        $value = null;
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    /* Validate Min Length Tests */
    public function testValidateMinLengthWithShorterValue(): void
    {
        $value = 'short';
        $minLength = 6;
        $result = self::validateMinLength($value, $minLength);
        $this->assertFalse($result);
    }

    public function testValidateMinLengthWithEqualValue(): void
    {
        $value = 'equal';
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertTrue($result);
    }

    public function testValidateMinLengthWithLongerValue(): void
    {
        $value = 'longer';
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertTrue($result);
    }

    public function testValidateMinLengthWithEmptyValue(): void
    {
        $value = '';
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertFalse($result);
    }

    public function testValidateMinLengthWithNullValue(): void
    {
        $value = null;
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertFalse($result);
    }
}
