<?php

namespace Sean\IbmPhpSdk\IBMCloud\Helpers;

use InvalidArgumentException;

/**
 * Class SpeechToTextOptionsHelper
 *
 * A helper class that provides a set of functions to manage the optional parameters that can be sent to SpeechToText API.
 */
class SpeechToTextParamsHelper extends AbstractVerifyExpectedType
{
    private static ?string $audio = null;
    private static array $audio_metrics = [true, false];
    private static array $continuous = [true, false];
    private static array $interim_results = [true, false];
    private static array $profanity_filter = [true, false];
    private static array $smart_formatting = [true, false];
    private static array $speaker_labels = [true, false];
    private static array $timestamps = [true, false];
    private static array $word_confidence = [true, false];
    private static float $keywords_threshold = 0.5;
    private static int $max_alternatives = 1;
    private static float $word_alternatives_threshold = 0.5;
    private static int $inactivity_timeout = -1;
    private static ?string $language_customization_id = null;
    private static ?string $customization_id = null;
    private static ?string $model = null;
    private static ?string $content_type = null;
    private static ?array $keywords = null;
    private static ?string $events = null;

    /**
     * Verifies the provided options array and returns a new array with only the valid options.
     *
     * @param array $options The options array to verify.
     * @return array The array of valid options.
     * @throws InvalidArgumentException If any of the provided options is invalid.
     */
    public static function verifyOptions(array $options): array
    {
        $validOptions = self::getValidOptions();
        $validOptionsKeys = array_keys($validOptions);
        $validOptionsValues = array_values($validOptions);

        foreach ($options as $key => $value) {
            $keyIndex = array_search($key, $validOptionsKeys);

            if ($keyIndex === false) {
                throw new InvalidArgumentException("Invalid option: $key.");
            }

            $expectedType = $validOptionsValues[$keyIndex];
            $actualType = gettype($value);

            if (is_array($expectedType) && !in_array($actualType, $expectedType)) {
                throw new InvalidArgumentException("Invalid type for option: '$key'. Expected one of " . implode(', ', $expectedType) . ", got $actualType.");
            } elseif ($expectedType === 'string' && $actualType !== 'string') {
                throw new InvalidArgumentException("Invalid type for option '$key'. Expected string, got $actualType.");
            }
        }
        return $options;
    }

    /**
     * Returns an array of valid options for the SpeechToText API.
     *
     * @return array The array of valid options.
     */
    public static function getValidOptions(): array
    {
        return [
            'audio' => self::$audio,
            'audio_metrics' => self::$audio_metrics,
            'continuous' => self::$continuous,
            'customization_id' => self::$customization_id,
            'events' => self::$events,
            'inactivity_timeout' => self::$inactivity_timeout,
            'interim_results' => self::$interim_results,
            'keywords' => self::$keywords,
            'keywords_threshold' => self::$keywords_threshold,
            'language_customization_id' => self::$language_customization_id,
            'max_alternatives' => self::$max_alternatives,
            'model' => self::$model,
            'content_type' => self::$content_type,
            'profanity_filter' => self::$profanity_filter,
            'smart_formatting' => self::$smart_formatting,
            'speaker_labels' => self::$speaker_labels,
            'timestamps' => self::$timestamps,
            'word_alternatives_threshold' => self::$word_alternatives_threshold,
            'word_confidence' => self::$word_confidence
        ];
    }

    /**
     * Verifies that a given option value is valid for the option with the given name.
     *
     * @param string $optionName The name of the option.
     * @param mixed $optionValue The value to check.
     * @throws InvalidArgumentException If the option name is invalid or the value is not valid for the option.
     */
    public static function verifyOption(string $optionName, $optionValue): void
    {
        if (!self::isValidOption($optionName)) {
            throw new InvalidArgumentException("Invalid option name: $optionName.");
        }

        if (!self::isValidOptionValue($optionName, $optionValue)) {
            throw new InvalidArgumentException("Invalid value for option $optionName: $optionValue.");
        }
    }

    /**
     * Checks if an option name is valid.
     *
     * @param string $optionName The name of the option to check.
     * @return bool True if the option name is valid, false otherwise.
     */
    public static function isValidOption(string $optionName): bool
    {
        return isset(self::getValidOptions()[$optionName]);
    }

    /**
     * Checks if a value is valid for a given option.
     *
     * @param string $optionName The name of the option.
     * @param mixed $optionValue The value to check.
     * @return bool True if the value is valid for the option, false otherwise.
     * @throws InvalidArgumentException If the option name is invalid.
     */
    public static function isValidOptionValue(string $optionName, mixed $optionValue): bool
    {
        $validOptions = self::getValidOptions();

        if (!isset($validOptions[$optionName])) {
            throw new InvalidArgumentException("Invalid option name: $optionName.");
        }

        return self::verifyExpectedType($validOptions, $optionName, $optionValue);
    }
}
