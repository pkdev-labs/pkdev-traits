<?php

namespace PkDev\Traits\Tests;

use PHPUnit\Framework\TestCase;
use PkDev\Traits\ValidationTrait;
use stdClass;

class ValidationTraitTest extends TestCase
{
    use ValidationTrait;

    /* Validate Required Tests */
    public function testValidateRequiredWithEmptyString()
    {
        $result = self::validateRequired('');
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithWhitespaceString()
    {
        $result = self::validateRequired('   ');
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithNull()
    {
        $result = self::validateRequired(null);
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithZero()
    {
        $result = self::validateRequired(0);
        $this->assertFalse($result);
    }

    public function testValidateRequiredWithNonEmptyString()
    {
        $result = self::validateRequired('Hello');
        $this->assertTrue($result);
    }

    public function testValidateRequiredWithArray()
    {
        $result = self::validateRequired(['item1', 'item2']);
        $this->assertTrue($result);
    }

    public function testValidateRequiredWithObject()
    {
        $result = self::validateRequired(new stdClass());
        $this->assertTrue($result);
    }

    /* Validate Email Tests */
    public function testValidateEmailWithValidEmail()
    {
        $validEmail = 'user@example.com';
        $result = self::validateEmail($validEmail);
        $this->assertTrue($result);
    }

    public function testValidateEmailWithInvalidEmail()
    {
        $invalidEmail = 'invalid-email';
        $result = self::validateEmail($invalidEmail);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithEmptyValue()
    {
        $emptyEmail = '';
        $result = self::validateEmail($emptyEmail);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithNullValue()
    {
        $nullEmail = null;
        $result = self::validateEmail($nullEmail);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithArray()
    {
        $emailArray = ['user@example.com'];
        $result = self::validateEmail($emailArray);
        $this->assertFalse($result);
    }

    public function testValidateEmailWithObject()
    {
        $emailObject = (object)['email' => 'user@example.com'];
        $result = self::validateEmail($emailObject);
        $this->assertFalse($result);
    }

    /* Validate Numeric Tests */
    public function testValidateNumericWithValidNumeric()
    {
        $validNumeric = 123;
        $result = self::validateNumeric($validNumeric);
        $this->assertTrue($result);
    }

    public function testValidateNumericWithInvalidNumeric()
    {
        $invalidNumeric = 'abc';
        $result = self::validateNumeric($invalidNumeric);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithEmptyValue()
    {
        $emptyValue = '';
        $result = self::validateNumeric($emptyValue);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithNullValue()
    {
        $nullValue = null;
        $result = self::validateNumeric($nullValue);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithArray()
    {
        $numericArray = [123];
        $result = self::validateNumeric($numericArray);
        $this->assertFalse($result);
    }

    public function testValidateNumericWithObject()
    {
        $numericObject = (object)['value' => 123];
        $result = self::validateNumeric($numericObject);
        $this->assertFalse($result);
    }

    /* Validate Integer Tests */
    public function testValidateIntegerWithValidInteger()
    {
        $validInteger = 123;
        $result = self::validateInteger($validInteger);
        $this->assertTrue($result);
    }

    public function testValidateIntegerWithInvalidInteger()
    {
        $invalidInteger = 'abc';
        $result = self::validateInteger($invalidInteger);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithEmptyValue()
    {
        $emptyValue = '';
        $result = self::validateInteger($emptyValue);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithNullValue()
    {
        $nullValue = null;
        $result = self::validateInteger($nullValue);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithArray()
    {
        $integerArray = [123];
        $result = self::validateInteger($integerArray);
        $this->assertFalse($result);
    }

    public function testValidateIntegerWithObject()
    {
        $integerObject = (object)['value' => 123];
        $result = self::validateInteger($integerObject);
        $this->assertFalse($result);
    }

    /* Validate Float Tests */
    public function testValidateFloatWithValidFloat()
    {
        $validFloat = 123.45;
        $result = self::validateFloat($validFloat);
        $this->assertTrue($result);
    }

    public function testValidateFloatWithInvalidFloat()
    {
        $invalidFloat = 'abc';
        $result = self::validateFloat($invalidFloat);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithEmptyValue()
    {
        $emptyValue = '';
        $result = self::validateFloat($emptyValue);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithNullValue()
    {
        $nullValue = null;
        $result = self::validateFloat($nullValue);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithArray()
    {
        $floatArray = [123.45];
        $result = self::validateFloat($floatArray);
        $this->assertFalse($result);
    }

    public function testValidateFloatWithObject()
    {
        $floatObject = (object)['value' => 123.45];
        $result = self::validateFloat($floatObject);
        $this->assertFalse($result);
    }

    /* Validate Max Length Tests */
    public function testValidateMaxLengthWithShorterValue()
    {
        $value = 'short';
        $maxLength = 10;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    public function testValidateMaxLengthWithEqualValue()
    {
        $value = 'equal';
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    public function testValidateMaxLengthWithLongerValue()
    {
        $value = 'toolong';
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertFalse($result);
    }

    public function testValidateMaxLengthWithEmptyValue()
    {
        $value = '';
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    public function testValidateMaxLengthWithNullValue()
    {
        $value = null;
        $maxLength = 5;
        $result = self::validateMaxLength($value, $maxLength);
        $this->assertTrue($result);
    }

    /* Validate Min Length Tests */
    public function testValidateMinLengthWithShorterValue()
    {
        $value = 'short';
        $minLength = 6;
        $result = self::validateMinLength($value, $minLength);
        $this->assertFalse($result);
    }

    public function testValidateMinLengthWithEqualValue()
    {
        $value = 'equal';
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertTrue($result);
    }

    public function testValidateMinLengthWithLongerValue()
    {
        $value = 'longer';
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertTrue($result);
    }

    public function testValidateMinLengthWithEmptyValue()
    {
        $value = '';
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertFalse($result);
    }

    public function testValidateMinLengthWithNullValue()
    {
        $value = null;
        $minLength = 5;
        $result = self::validateMinLength($value, $minLength);
        $this->assertFalse($result);
    }
}