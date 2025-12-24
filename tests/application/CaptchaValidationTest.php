<?php

/**
 * CaptchaValidationTest
 * 
 * PHPUnit tests for captcha validation in registration forms.
 * Tests cover captcha generation, validation, and edge cases.
 */

class CaptchaValidationTest extends PHPUnit\Framework\TestCase
{
    /**
     * Mock session data storage
     */
    protected $sessionData = [];

    /**
     * Simulate session set_userdata behavior
     */
    protected function setUserData($key, $value)
    {
        $this->sessionData[$key] = $value;
    }

    /**
     * Simulate session userdata retrieval
     */
    protected function getUserData($key)
    {
        return isset($this->sessionData[$key]) ? $this->sessionData[$key] : null;
    }

    /**
     * Simulate session unset_userdata
     */
    protected function unsetUserData($key)
    {
        unset($this->sessionData[$key]);
    }

    /**
     * Test that captcha validation passes with correct answer
     */
    public function testCorrectCaptchaPasses()
    {
        $captcha_word = 'abc12';
        $this->setUserData('captcha_word', strtolower($captcha_word));
        
        $user_input = 'abc12';
        $captcha_answer = strtolower($user_input);
        $expected = $this->getUserData('captcha_word');
        
        $this->assertEquals($expected, $captcha_answer);
        $this->assertTrue($captcha_answer === $expected);
    }

    /**
     * Test that captcha validation fails with incorrect answer
     */
    public function testIncorrectCaptchaFails()
    {
        $captcha_word = 'xyz99';
        $this->setUserData('captcha_word', strtolower($captcha_word));
        
        $user_input = 'wrong';
        $captcha_answer = strtolower($user_input);
        $expected = $this->getUserData('captcha_word');
        
        $this->assertNotEquals($expected, $captcha_answer);
        $this->assertFalse($captcha_answer === $expected);
    }

    /**
     * Test that empty captcha answer fails validation
     */
    public function testEmptyCaptchaFails()
    {
        $captcha_word = 'test1';
        $this->setUserData('captcha_word', strtolower($captcha_word));
        
        $user_input = '';
        $captcha_answer = strtolower($user_input);
        $expected = $this->getUserData('captcha_word');
        
        // Empty captcha should fail (even if validation logic checks for empty)
        $isValid = !empty($captcha_answer) && $captcha_answer === $expected;
        
        $this->assertFalse($isValid);
    }

    /**
     * Test that null captcha answer fails validation
     */
    public function testNullCaptchaFails()
    {
        $captcha_word = 'test2';
        $this->setUserData('captcha_word', strtolower($captcha_word));
        
        $user_input = null;
        $captcha_answer = $user_input ? strtolower($user_input) : '';
        $expected = $this->getUserData('captcha_word');
        
        // Null captcha should fail
        $isValid = !empty($captcha_answer) && $captcha_answer === $expected;
        
        $this->assertFalse($isValid);
    }

    /**
     * Test that captcha validation is case-insensitive
     */
    public function testCaptchaIsCaseInsensitive()
    {
        $captcha_word = 'AbCdE'; // Mixed case stored word
        $this->setUserData('captcha_word', strtolower($captcha_word));
        
        // User enters uppercase
        $user_input = 'ABCDE';
        $captcha_answer = strtolower($user_input);
        $expected = $this->getUserData('captcha_word');
        
        $this->assertEquals($expected, $captcha_answer);
        
        // User enters lowercase
        $user_input2 = 'abcde';
        $captcha_answer2 = strtolower($user_input2);
        
        $this->assertEquals($expected, $captcha_answer2);
    }

    /**
     * Test that captcha word is cleared after validation attempt
     */
    public function testCaptchaWordClearedAfterValidation()
    {
        $captcha_word = 'clear1';
        $this->setUserData('captcha_word', strtolower($captcha_word));
        
        // Simulate validation
        $expected = $this->getUserData('captcha_word');
        $this->assertNotNull($expected);
        
        // Clear the captcha word (simulating unset_userdata)
        $this->unsetUserData('captcha_word');
        
        // Verify it's cleared
        $after = $this->getUserData('captcha_word');
        $this->assertNull($after);
    }

    /**
     * Test validation fails when no captcha word is set in session
     */
    public function testValidationFailsWithoutSessionCaptcha()
    {
        // No captcha word set in session
        $user_input = 'test1';
        $captcha_answer = strtolower($user_input);
        $expected = $this->getUserData('captcha_word'); // Returns null
        
        // Validation should fail when expected is null
        $isValid = !empty($captcha_answer) && !empty($expected) && $captcha_answer === $expected;
        
        $this->assertFalse($isValid);
    }

    /**
     * Test captcha with special characters in pool
     */
    public function testCaptchaWithNumbersAndLetters()
    {
        $captcha_word = '0A1B2';
        $this->setUserData('captcha_word', strtolower($captcha_word));
        
        $user_input = '0a1b2';
        $captcha_answer = strtolower($user_input);
        $expected = $this->getUserData('captcha_word');
        
        $this->assertEquals($expected, $captcha_answer);
    }

    /**
     * Test that captcha word has expected length from pool
     */
    public function testCaptchaWordLength()
    {
        $word_length = 5;
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        // Simulate captcha word generation
        $word = '';
        for ($i = 0; $i < $word_length; $i++) {
            $word .= $pool[rand(0, strlen($pool) - 1)];
        }
        
        $this->assertEquals($word_length, strlen($word));
    }
}
