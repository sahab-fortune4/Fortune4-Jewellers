<?php

declare(strict_types=1);

namespace Laminas\Filter;

use Laminas\Stdlib\ArrayUtils;
use Traversable;

use function array_shift;
use function func_get_args;
use function function_exists;
use function htmlentities;
use function iconv;
use function is_array;
use function is_scalar;
use function strlen;

use const ENT_QUOTES;

/**
 * @psalm-type Options = array{
 *     quote_style?: int,
 *     encoding?: string,
 *     double_quote?: bool,
 *     ...
 * }
 * @extends AbstractFilter<Options>
 * @final
 */
class HtmlEntities extends AbstractFilter
{
    /**
     * Corresponds to the second htmlentities() argument
     *
     * @var int
     */
    protected $quoteStyle;

    /**
     * Corresponds to the third htmlentities() argument
     *
     * @var string
     */
    protected $encoding;

    /**
     * Corresponds to the forth htmlentities() argument
     *
     * @var bool
     */
    protected $doubleQuote;

    /**
     * Sets filter options
     *
     * @param array|Traversable $options
     */
    public function __construct($options = [])
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }
        if (! is_array($options)) {
            $options            = func_get_args();
            $temp['quotestyle'] = array_shift($options);
            if (! empty($options)) {
                $temp['charset'] = array_shift($options);
            }

            $options = $temp;
        }

        if (! isset($options['quotestyle'])) {
            $options['quotestyle'] = ENT_QUOTES;
        }

        if (! isset($options['encoding'])) {
            $options['encoding'] = 'UTF-8';
        }
        if (isset($options['charset'])) {
            $options['encoding'] = $options['charset'];
        }

        if (! isset($options['doublequote'])) {
            $options['doublequote'] = true;
        }

        $this->setQuoteStyle($options['quotestyle']);
        $this->setEncoding($options['encoding']);
        $this->setDoubleQuote($options['doublequote']);
    }

    /**
     * Returns the quoteStyle option
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0 without replacement
     *
     * @return int
     */
    public function getQuoteStyle()
    {
        return $this->quoteStyle;
    }

    /**
     * Sets the quoteStyle option
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0. Set options during construction instead
     *
     * @param int $quoteStyle
     * @return self Provides a fluent interface
     */
    public function setQuoteStyle($quoteStyle)
    {
        $this->quoteStyle = $quoteStyle;
        return $this;
    }

    /**
     * Get encoding
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0 without replacement
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set encoding
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0. Set options during construction instead
     *
     * @param string $value
     * @return self
     */
    public function setEncoding($value)
    {
        $this->encoding = (string) $value;
        return $this;
    }

    /**
     * Returns the charSet option
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0 without replacement
     *
     * Proxies to {@link getEncoding()}
     *
     * @return string
     */
    public function getCharSet()
    {
        return $this->getEncoding();
    }

    /**
     * Sets the charSet option
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0. Set options during construction instead
     *
     * Proxies to {@link setEncoding()}
     *
     * @param string $charSet
     * @return self Provides a fluent interface
     */
    public function setCharSet($charSet)
    {
        return $this->setEncoding($charSet);
    }

    /**
     * Returns the doubleQuote option
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0 without replacement
     *
     * @return bool
     */
    public function getDoubleQuote()
    {
        return $this->doubleQuote;
    }

    /**
     * Sets the doubleQuote option
     *
     * @deprecated Since 2.40.0. This method will be removed in 3.0. Set options during construction instead
     *
     * @param bool $doubleQuote
     * @return self Provides a fluent interface
     */
    public function setDoubleQuote($doubleQuote)
    {
        $this->doubleQuote = (bool) $doubleQuote;
        return $this;
    }

    /**
     * Defined by Laminas\Filter\FilterInterface
     *
     * Returns the string $value, converting characters to their corresponding HTML entity
     * equivalents where they exist
     *
     * If the value provided is non-scalar, the value will remain unfiltered
     *
     * @param  mixed $value
     * @return string|mixed
     * @throws Exception\DomainException On encoding mismatches.
     * @psalm-return ($value is scalar ? string : mixed)
     */
    public function filter($value)
    {
        if (! is_scalar($value)) {
            return $value;
        }
        $value = (string) $value;

        $filtered = htmlentities($value, $this->getQuoteStyle(), $this->getEncoding(), $this->getDoubleQuote());
        if (strlen($value) && ! strlen($filtered)) {
            if (! function_exists('iconv')) {
                throw new Exception\DomainException('Encoding mismatch has resulted in htmlentities errors');
            }
            $enc      = $this->getEncoding();
            $value    = iconv('', $this->getEncoding() . '//IGNORE', $value);
            $filtered = htmlentities($value, $this->getQuoteStyle(), $enc, $this->getDoubleQuote());
            if (! strlen($filtered)) {
                throw new Exception\DomainException('Encoding mismatch has resulted in htmlentities errors');
            }
        }
        return $filtered;
    }
}
