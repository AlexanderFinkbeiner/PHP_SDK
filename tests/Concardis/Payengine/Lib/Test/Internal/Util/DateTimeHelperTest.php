<?php

namespace Concardis\Payengine\Lib\Test\Internal\Util;

use Concardis\Payengine\Lib\Internal\Util\DateTimeHelper;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\Assert;

require_once __DIR__ . "/../../../../../../../autoload.php";


class DateTimeHelperTest extends TestCase
{

    public function isValidTimeStamp_withValidDates_shouldSucceed(){
        $this->assertTrue( DateTimeHelper::isValidTimeStamp(time()) );
        $this->assertTrue( DateTimeHelper::isValidTimeStamp("123") );
        $this->assertTrue( DateTimeHelper::isValidTimeStamp(123) );
        $this->assertTrue( DateTimeHelper::isValidTimeStamp(123.01) );
    }

    public function isValidTimeStamp_withInValidDates_shouldSucceed(){
        $this->assertFalse( DateTimeHelper::isValidTimeStamp("abc") );
        $this->assertFalse( DateTimeHelper::isValidTimeStamp("12a3") );
    }

    /**
     * Test conversion to RFC3339 Format
     */
    public function convertNumericToDateTime_withValidTimestamp_shouldSucceed(){
        $TestValues = array(
            634478400 => "1990-02-08T12:00:00+00:00",
            1364218889 => "2013-03-25T13:41:29+00:00"
        );

        foreach ($TestValues as $inputValue => $expectedOutput){
            $dateTime = DateTimeHelper::convertNumericToDateTime($inputValue);
            $this->assertInstanceOf("DateTime", $dateTime);
            $this->assertEquals($expectedOutput, $dateTime->format(DATE_RFC3339));
        }
    }

    /**
     * Test conversion to RFC3339 Format
     */
    public function convertNumericToDateTime_withInValidString_shouldFail(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Must be a valid numeric value or DateTime');

        DateTimeHelper::convertNumericToDateTime("a23aca1");
    }

    /**
     * Test conversion to RFC3339 Format
     */
    public function convertNumericToDateTime_withValidDateTime_shouldSucceed(){
        $inputValue = new \DateTime("@1364218889");
        $expectedOutput = "2013-03-25T13:41:29+00:00";

        $dateTime = DateTimeHelper::convertNumericToDateTime($inputValue);
        $this->assertInstanceOf("DateTime", $dateTime);
        $this->assertEquals($expectedOutput, $dateTime->format(DATE_RFC3339));
    }

    public function getMillisecondFromDateTime_withValidDates_shouldSucceed(){
        $this->assertEquals(634478400000, DateTimeHelper::getMillisecondFromDateTime(new \DateTime("@634478400")));
        $this->assertEquals(1364218889000, DateTimeHelper::getMillisecondFromDateTime(new \DateTime("@1364218889")));
    }

}