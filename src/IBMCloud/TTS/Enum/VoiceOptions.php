<?php

declare(strict_types=1);

namespace Sean\IbmPhpSdk\IBMCloud\TTS\Enum;

final class VoiceOptions
{
    public const AR_AR_OMAR_VOICE = 'ar-AR_OmarVoice';
    public const DE_DE_BIRGIT_V2_VOICE = 'de-DE_BirgitV2Voice';
    public const DE_DE_BIRGIT_V3_VOICE = 'de-DE_BirgitV3Voice';
    public const DE_DE_BIRGIT_VOICE = 'de-DE_BirgitVoice';
    public const DE_DE_DIETER_V2_VOICE = 'de-DE_DieterV2Voice';
    public const DE_DE_DIETER_V3_VOICE = 'de-DE_DieterV3Voice';
    public const DE_DE_DIETER_VOICE = 'de-DE_DieterVoice';
    public const DE_DE_ERIKA_V3_VOICE = 'de-DE_ErikaV3Voice';
    public const EN_GB_KATE_V3_VOICE = 'en-GB_KateV3Voice';
    public const EN_GB_KATE_VOICE = 'en-GB_KateVoice';
    public const EN_US_ALLISON_V2_VOICE = 'en-US_AllisonV2Voice';
    public const EN_US_ALLISON_V3_VOICE = 'en-US_AllisonV3Voice';
    public const EN_US_ALLISON_VOICE = 'en-US_AllisonVoice';
    public const EN_US_EMILY_V3_VOICE = 'en-US_EmilyV3Voice';
    public const EN_US_HENRY_V3_VOICE = 'en-US_HenryV3Voice';
    public const EN_US_KEVIN_V3_VOICE = 'en-US_KevinV3Voice';
    public const EN_US_LISA_V2_VOICE = 'en-US_LisaV2Voice';
    public const EN_US_LISA_V3_VOICE = 'en-US_LisaV3Voice';
    public const EN_US_LISA_VOICE = 'en-US_LisaVoice';
    public const EN_US_MICHAEL_V2_VOICE = 'en-US_MichaelV2Voice';
    public const EN_US_MICHAEL_V3_VOICE = 'en-US_MichaelV3Voice';
    public const EN_US_MICHAEL_VOICE = 'en-US_MichaelVoice';
    public const EN_US_OLIVIA_V3_VOICE = 'en-US_OliviaV3Voice';
    public const ES_ES_ENRIQUE_V3_VOICE = 'es-ES_EnriqueV3Voice';
    public const ES_ES_ENRIQUE_VOICE = 'es-ES_EnriqueVoice';
    public const ES_ES_LAURA_V3_VOICE = 'es-ES_LauraV3Voice';
    public const ES_ES_LAURA_VOICE = 'es-ES_LauraVoice';
    public const ES_LA_SOFIA_V3_VOICE = 'es-LA_SofiaV3Voice';
    public const ES_LA_SOFIA_VOICE = 'es-LA_SofiaVoice';
    public const ES_US_SOFIA_V3_VOICE = 'es-US_SofiaV3Voice';
    public const ES_US_SOFIA_VOICE = 'es-US_SofiaVoice';
    public const FR_FR_RENEE_V3_VOICE = 'fr-FR_ReneeV3Voice';
    public const FR_FR_RENEE_VOICE = 'fr-FR_ReneeVoice';
    public const IT_IT_FRANCESCA_V2_VOICE = 'it-IT_FrancescaV2Voice';
    public const IT_IT_FRANCESCA_V3_VOICE = 'it-IT_FrancescaV3Voice';
    public const IT_IT_FRANCESCA_VOICE = 'it-IT_FRANCESCAVoice';
    public const JA_JP_EMI_V3_VOICE = 'ja-JP_EmiV3Voice';
    public const JA_JP_EMI_VOICE = 'ja-JP_EmiVoice';
    public const NL_NL_EMMA_VOICE = 'nl-NL_EmmaVoice';
    public const NL_NL_LIAM_VOICE = 'nl-NL_LiamVoice';
    public const PT_BR_ISABELA_V3_VOICE = 'pt-BR_IsabelaV3Voice';
    public const PT_BR_ISABELA_VOICE = 'pt-BR_IsabelaVoice';
    public const ZH_CN_LINA_VOICE = 'zh-CN_LiNaVoice';
    public const ZH_CN_WANG_WEI_VOICE = 'zh-CN_WangWeiVoice';
    public const ZH_CN_ZHANG_JING_VOICE = 'zh-CN_ZhangJingVoice';

    /**
     * List of available voice options
     *
     * @var array
     */
    public static array $availableOptions = [
        self::AR_AR_OMAR_VOICE,
        self::DE_DE_BIRGIT_V2_VOICE,
        self::DE_DE_BIRGIT_V3_VOICE,
        self::DE_DE_BIRGIT_VOICE,
        self::DE_DE_DIETER_V2_VOICE,
        self::DE_DE_DIETER_V3_VOICE,
        self::DE_DE_DIETER_VOICE,
        self::DE_DE_ERIKA_V3_VOICE,
        self::EN_GB_KATE_V3_VOICE,
        self::EN_GB_KATE_VOICE,
        self::EN_US_ALLISON_V2_VOICE,
        self::EN_US_ALLISON_V3_VOICE,
        self::EN_US_ALLISON_VOICE,
        self::EN_US_EMILY_V3_VOICE,
        self::EN_US_HENRY_V3_VOICE,
        self::EN_US_KEVIN_V3_VOICE,
        self::EN_US_LISA_V2_VOICE,
        self::EN_US_LISA_V3_VOICE,
        self::EN_US_LISA_VOICE,
        self::EN_US_MICHAEL_V2_VOICE,
        self::EN_US_MICHAEL_V3_VOICE,
        self::EN_US_MICHAEL_VOICE,
        self::EN_US_OLIVIA_V3_VOICE,
        self::ES_ES_ENRIQUE_V3_VOICE,
        self::ES_ES_ENRIQUE_VOICE,
        self::ES_ES_LAURA_V3_VOICE,
        self::ES_ES_LAURA_VOICE,
        self::ES_LA_SOFIA_V3_VOICE,
        self::ES_LA_SOFIA_VOICE,
        self::ES_US_SOFIA_V3_VOICE,
        self::ES_US_SOFIA_VOICE,
        self::FR_FR_RENEE_V3_VOICE,
        self::FR_FR_RENEE_VOICE,
        self::IT_IT_FRANCESCA_V2_VOICE,
        self::IT_IT_FRANCESCA_V3_VOICE,
        self::IT_IT_FRANCESCA_VOICE,
        self::JA_JP_EMI_V3_VOICE,
        self::JA_JP_EMI_VOICE,
        self::NL_NL_EMMA_VOICE,
        self::NL_NL_LIAM_VOICE,
        self::PT_BR_ISABELA_V3_VOICE,
        self::PT_BR_ISABELA_VOICE,
        self::ZH_CN_LINA_VOICE,
        self::ZH_CN_WANG_WEI_VOICE,
        self::ZH_CN_ZHANG_JING_VOICE,
    ];
}
