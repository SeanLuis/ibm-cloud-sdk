<?php

namespace Sean\IbmPhpSdk\IBMCloud\STT\Enum;

class MultimediaModels
{
    public const DUTCH_NETHERLANDS = 'nl-NL_Multimedia';
    public const ENGLISH_AUSTRALIAN = 'en-AU_Multimedia';
    public const ENGLISH_UNITED_KINGDOM = 'en-GB_Multimedia';
    public const ENGLISH_UNITED_STATES = 'en-US_Multimedia';
    public const FRENCH_CANADIAN = 'fr-CA_Multimedia';
    public const FRENCH_FRANCE = 'fr-FR_Multimedia';
    public const GERMAN = 'de-DE_Multimedia';
    public const ITALIAN = 'it-IT_Multimedia';
    public const JAPANESE = 'ja-JP_Multimedia';
    public const KOREAN = 'ko-KR_Multimedia';
    public const PORTUGUESE_BRAZILIAN = 'pt-BR_Multimedia';
    public const SPANISH_CASTILIAN = 'es-ES_Multimedia';

    public static array $availableOptions = [
        self::DUTCH_NETHERLANDS,
        self::ENGLISH_AUSTRALIAN,
        self::ENGLISH_UNITED_KINGDOM,
        self::ENGLISH_UNITED_STATES,
        self::FRENCH_CANADIAN,
        self::FRENCH_FRANCE,
        self::GERMAN,
        self::ITALIAN,
        self::JAPANESE,
        self::KOREAN,
        self::PORTUGUESE_BRAZILIAN,
        self::SPANISH_CASTILIAN,
    ];
}