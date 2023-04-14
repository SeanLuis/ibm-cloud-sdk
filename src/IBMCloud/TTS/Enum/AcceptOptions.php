<?php

declare(strict_types=1);

namespace Sean\IbmPhpSdk\IBMCloud\TTS\Enum;

final class AcceptOptions
{
    public const AUDIO_BASIC = 'audio/basic';
    public const AUDIO_FLAC = 'audio/flac';
    public const AUDIO_L16 = 'audio/l16';
    public const AUDIO_OGG = 'audio/ogg';
    public const AUDIO_OGG_CODECS_OPUS = 'audio/ogg;codecs=opus';
    public const AUDIO_MP3 = 'audio/mp3';
    public const AUDIO_MPEG = 'audio/mpeg';
    public const AUDIO_MPEG3 = 'audio/mpeg3';
    public const AUDIO_MULAW = 'audio/mulaw';
    public const AUDIO_WAV = 'audio/wav';
    public const AUDIO_WEBM = 'audio/webm';
    public const AUDIO_WEBM_CODECS_OPUS = 'audio/webm;codecs=opus';
    public const AUDIO_WEBM_CODECS_VORBIS = 'audio/webm;codecs=vorbis';

    public static array $availableOptions = [
        self::AUDIO_BASIC,
        self::AUDIO_FLAC,
        self::AUDIO_L16,
        self::AUDIO_OGG,
        self::AUDIO_OGG_CODECS_OPUS,
        self::AUDIO_MP3,
        self::AUDIO_MPEG,
        self::AUDIO_MPEG3,
        self::AUDIO_MULAW,
        self::AUDIO_WAV,
        self::AUDIO_WEBM,
        self::AUDIO_WEBM_CODECS_OPUS,
        self::AUDIO_WEBM_CODECS_VORBIS,
    ];
}