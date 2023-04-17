# IBM Cloud SDK for PHP

The IBM Cloud SDK for PHP is a library that provides an easy way to interact with IBM Cloud services from applications
written in PHP. The SDK currently supports IBM NLU and IBM COS.

### Requirements

| Requisito         | Versión requerida | Enlace de descarga                |
|-------------------|-------------------|-----------------------------------|
| PHP               | ^8.1              | https://www.php.net/downloads     |
| GuzzleHTTP/Guzzle | ^7.5              | https://github.com/guzzle/guzzle  |
| Symfony/Yaml      | ^6.2              | https://github.com/symfony/yaml   |
| Symfony/Dotenv    | ^6.2              | https://github.com/symfony/dotenv |
| ext-yaml          | *                 | N/A                               |
| ext-fileinfo      | *                 | N/A                               |
| ext-curl          | *                 | N/A                               |
| ext-simplexml     | *                 | N/A                               |

It is important to ensure that the required PHP extensions are enabled in the server environment. The SDK also requires
access to the IBM Cloud services that it is interacting with, such as IBM Cloud Object Storage and IBM Watson Natural
Language Understanding.

Note that the composer package manager will automatically install all the required dependencies and their dependencies
during installation of the SDK.

### Installation

To install the SDK, you can use Composer. If you don't already have Composer installed on your system, follow the
instructions at https://getcomposer.org to install it.

**Run the following command in your terminal to install the SDK:**

```CMD 
composer require sean-luis/ibm-php-sdk
```

### Setting

Before using the **SDK**, you must set up your **IBM Cloud credentials**. You can do it by creating a **YAML** file
or **ENV** file in the root directory of your project with the following keys

```YAML
ibm:
    api_key: "<IBM_CLOUD_API_KEY>"
    url: "<IBM_CLOUD_URL>"

nlu:
    api_key: "<IBM_NLU_API_KEY>"
    url: "<IBM_NLU_URL>"
    version: "<IBM_NLU_VERSION>"

cos:
    api_key: "<IBM_COS_API_KEY>"
    url: "<IBM_COS_URL>"
    region: "<IBM_COS_REGION>"
    bucket: "<IBM_COS_BUCKET>"
    instance_id: "<IBM_COS_INSTANCE_ID>"

tts:
    api_key: "<IBM_TTS_API_KEY>"
    url: "<IBM_TTS_URL>"
    version: "<IBM_TTS_VERSION>"
    
stt:
    api_key: "<IBM_STT_API_KEY>"
    url: "<IBM_STT_URL>"
    version: "<IBM_STT_VERSION>"
```

Or you can use **ENV**:

```dotenv
IBM_NLU_API_KEY=<IBM_NLU_API_KEY>
IBM_NLU_URL=<IBM_NLU_URL>
IBM_NLU_VERSION=<IBM_NLU_VERSION>

IBM_COS_API_KEY=<IBM_COS_API_KEY>
IBM_COS_URL=<IBM_COS_URL>
IBM_COS_REGION=<IBM_COS_REGION>
IBM_COS_BUCKET=<IBM_COS_BUCKET>
IBM_COS_REFERENCE_SERCICE_ID=<IBM_COS_INSTANCE_ID>

IBM_TTS_API_KEY=<IBM_TTS_API_KEY>
IBM_TTS_URL=<IBM_TTS_URL>
IBM_TTS_VERSION=<IBM_TTS_VERSION>

IBM_STT_API_KEY=<IBM_STT_API_KEY>
IBM_STT_URL=<IBM_STT_URL>
IBM_STT_VERSION=<IBM_STT_VERSION>

IBM_CLOUD_API_KEY=<IBM_CLOUD_APIKEY>
IBM_CLOUD_URL=<IBM_CLOUD_URL>
```

Replace the variables you think you'll use in each case you see fit with your own IBM Cloud credentials.

# Implementation

## **Natural Language Understanding**

The **NaturalLanguageUnderstanding** class provides an easy way to interact with **IBM NLU**.

```php
use IBMCloud\Helpers\Config;
use IBMCloud\NLU\NaturalLanguageUnderstanding;

// Load IBM Cloud credentials from a YAML file
$credentials = Config::getCredentials('ibm-cloud.yaml');

$authenticator = new IamAuthenticator($credentials['ibm']['api_key']);

$token = $authenticator->getAccessToken();

// Create an instance of NaturalLanguageUnderstanding
$nlu = new NaturalLanguageUnderstanding($token, $url, $version);

// Define the text to analyze
$text = "I am very happy with the result of today's game.";

// Define your feature options for text analysis
$options = [
    'entities' => [
        'sentiment' => true,
        'emotion' => true,
        'limit' => 10,
    ],
    'keywords' => [
        'sentiment' => true,
        'emotion' => true,
        'limit' => 10,
    ],
    'sentiment' => [
        'document' => true,
    ],
    'categories' => [
        'limit' => 5,
    ],
];

// Instantiate NLUFeaturesParams with custom options
$nluFeaturesParams = new NLUFeaturesParams($options);

// Make the request to IBM NLU
$response = $nlu->analyze($text, $features);

// Print the results
foreach ($response['keywords'] as $keyword) {
    echo $keyword['text'].' => Sentiment: '.$keyword['sentiment']['score'].', Emotion: '.$keyword['emotion']['sadness']
    .'<br>';
}
```

> Creates a new instance of the Natural Language Understanding class.
```PHP
new NaturalLanguageUnderstanding($token, $url, $version)
```

**Parameters:**

```
$token (string): The IBM Cloud response token.
$url (string): IBM NLU URL.
$version (string): The version of IBM NLU.
```

### Analyze

> Parses the supplied text using IBM NLU and returns the results.
```PHP
$nlu->analyze($text, $features)
```

**Parameters:**

```
$text (string): El texto a analizar.
$features (array): The characteristics that you want to analyze. See the IBM NLU documentation for a complete list of available features.
```

**Response:**
An array containing the results of the analysis.

### AnalysisFeature

> Represents the features that can be analyzed with Natural Language Understanding.
```PHP
new NLUFeaturesParams($options)
```

## **Cloud Object Storage**

The **CloudObjectStorage** class provides an easy way to interact with **IBM COS**.

```php
use IBMCloud\Helpers\Config;
use IBMCloud\COS\CloudObjectStorage;

// Load IBM Cloud credentials from a YAML file
$credentials = Config::getCredentials('ibm-cloud.yaml');

// Sign in and get IBM Cloud token
$authenticator = new IamAuthenticator($credentials['ibm']['api_key']);

$token = $authenticator->getAccessToken();

// Create an instance of CloudObjectStorage
$this->cos = new CloudObjectStorage(
    $token,
    $credentials['cos']['instance_id'],
    $credentials['cos']['url']
);        

// Upload a file to IBM COS
$objectName = 'test.txt';
$body = 'Este es un archivo de prueba.';
$response = $cos->putObject($credentials['cos']['bucket'], $objectName, $body);

// Download a file from IBM COS
$fileName = 'test.txt';
$response = $cos->getObject($bucket, $fileName);

// Print the content of the downloaded file
echo $response;
```

> Creates a new instance of the CloudObjectStorage class.
```PHP
new CloudObjectStorage($token, $serviceInstanceId, $endpoint, $bucketName)
```

**Parameters:**

```
$token (string): The IBM Cloud response token.
$serviceInstanceId (string): The IBM COS service instance ID.
$endpoint (string): The IBM COS endpoint.
$bucketName (string): The name of the IBM COS bucket.
```

### PutObject

> Upload a file to IBM COS.
```PHP
$cos->putObject($bucketName, $objectName, $body);
```

**Parameters:**

```
$bucketName (string): Bucket name where the object is to be uploaded.
$objectName (string): The name of the object to load.
$body (string): The content of the object to load, either as a string or a resource.
$contentType (string|null): The content type of the object. If not specified, the service will choose a default content type.
$metadata (array): Optional metadata to add to the target object.
```

**Response**
Response true or false at the end of the request.

### GetObject

> Downloads a file from IBM COS.
```PHP
$cos->getObject($bucket, $fileName);
```

**Parameters:**

```
$bucket (string): The name of the bucket from which the file will be downloaded.
$fileName (string): The name of the file to download.
```

**Response:**
The content of the downloaded file.

### CopyObject

> Copies an object to another bucket, optionally renaming the object.
```PHP
$cos->copyObject($sourceBucket, $sourceObject, $destinationBucket, $destinationObject, $contentType = null, $metadata = []);
```

**Parameters:**

```
$sourceBucket (string): Origin bucket name.
$sourceObject (string): The name of the source object to copy.
$destinationBucket (string): Destination bucket name.
$destinationObject (string): Name of the target object. If not specified, the name of the source object is used.
$contentType (string|null): The content type of the object. If not specified, the service will choose a default content type.
$metadata (array): Optional metadata to add to the target object.
```

**Response:**
True if the operation completed successfully, false otherwise.

### DeleteObject

> Delete a object from the specified bucket.
```PHP
$cos->deleteObject($bucketName, $objectName);
```

**Parameters:**

```
$bucketName (string): Bucket name.
$objectName (string): Name of the object to delete.
```

**Response:**
True if the operation completed successfully, false otherwise.

### ListObjects

> Lists the objects in the specified bucket.
```PHP
$cos->listObjects($bucketName, $prefix = null, $delimiter = null);
```

**Parameters:**

```
$bucketName (string): Bucket name.
$prefix (string|null): Prefix used to filter objects by key name.
$delimiter (string|null): Used delimiter
```

**Response:**
Response a list of objects belonging to the provided bucket.

### CreateBucket

> Creates a new bucket in the specified region.
```PHP
$cos->createBucket($bucketName, $region);
```

**Parameters:**

```
$bucketName (string): The name of the new bucket.
$region (string|null): The region in which the bucket will be created. If not specified, the service's default region will be used.
```

**Response:**
True if the operation completed successfully, false otherwise.

### DeleteBucket

> Elimina un bucket existente.
```PHP
$cos->deleteBucket($bucketName);
```

**Parameters:**

```
$bucketName (string):The name of the bucket to delete.
```

**Response:**
True if the operation completed successfully, false otherwise.

## **Text To Speech**

The **TextToSpeech** class provides an easy way to interact with **IBM TTS**.

```php
use IBMCloud\Helpers\Config;
use IBMCloud\TTS\TextToSpeech;

// Load IBM Cloud credentials from a YAML file
$credentials = Config::getCredentials('ibm-cloud.yaml');

$token = $authenticator->getAccessToken();

// Create an instance of TextToSpeech
$tts = new TextToSpeech(
    $token,
    $credentials['tts']['url']
);

// Define the necessary parameters
$text = 'This is a test.';

// The VoiceOptionsEnum class contains the supported voice models.
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\VoiceOptions;
$voice = VoiceOptions::EN_US_ALLISON_V3_VOICE;

// The AcceptOptionsEnum class contains the accepted audio formats.
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\AcceptOptions;
$accept = AcceptOptions::AUDIO_MP3;

// Make the request to IBM TTS
$audio = $tts->synthesize($text, $accept, $voice);

// Export the audio to a folder
file_put_contents('./path/to/audio.mp3', $audio);
```

> Creates a new instance of the Text To Speech class.
```PHP
new TextToSpeech($token, $url)
```

**Parameters:**

```
$token (string): The IBM Cloud response token.
$url (string): IBM TTS URL.
$version (string): Service version, by deafault V1.
```

### Synthesize

> Synthesize audio from text using the Text to Speech service.
```PHP
$ttf->synthesize($text, $accept, $voice);
```

**Parameters:**

```
$text (string): The text to synthesize audio from.
$accept (string): The audio format to return. Acceptable values can be found in the AcceptOptionsEnum class.
$voice (string): The voice to use for the audio. Acceptable values can be found in the VoiceOptionsEnum class.
```

**Response:**
The synthesized audio in the requested format.

## **Speech To Text**

The **SpeechToText** class provides an easy way to interact with **IBM STT**.

```php
use IBMCloud\Helpers\Config;
use IBMCloud\STT\SpeechToText;

// Load IBM Cloud credentials from a YAML file
$credentials = Config::getCredentials('ibm-cloud.yaml');

$token = $authenticator->getAccessToken();

// Create an instance of TextToSpeech
$sst = new SpeechToText(
    $token,
    $credentials['stt']['url']
);

// Define the necessary parameters
$path = __DIR__.'\audio.mp3';

$params = new SpeechToTextParams([
    'audio' => $path,
    'content_type' => 'audio/mp3',
    'model' => MultimediaModels::SPANISH_CASTILIAN,
    'timestamps' => true,
    'word_alternatives_threshold' => 0.9,
    'keywords' => ['example', 'keyword'],
    'keywords_threshold' => 0.5
]);

// Make the request to IBM STT
$transcript = $sst->recognize($params);

// Display transcribed content based on sent audio.
echo $transcript;
```

> Creates a new instance of the Speech To Text class.
```PHP
new SpeechToText($token, $url)
```

**Parameters:**

```
$token (string): The IBM Cloud response token.
$url (string): IBM TTS URL.
$version (string): Service version, by deafault V1.
```

### Recognize

> Recognize is a method that sends a POST request to the IBM Cloud Speech to Text API to transcribe an audio file.
```PHP
$stt->recognize($params);
```

**Parameters:**

```
$params (array): List of possible options.
```

```php
new SpeechToTextParams([
    'audio' => $path,
    'content_type' => 'audio/mp3',
    'model' => MultimediaModels::SPANISH_CASTILIAN,
    'timestamps' => true,
    'word_alternatives_threshold' => 0.9,
    'keywords' => ['example', 'keyword'],
    'keywords_threshold' => 0.5
])
```

- **audio:** the path or content of the audio file to transcribe.
- **audio_metrics:** a boolean value indicating whether you want information about the quality of the input audio, such
  as whether there is noise or whether speech is clear.
- **continuous:** a boolean indicating whether continuous transcription (continue transcribing until audio input stops)
  or single file transcription is desired.
- **customization_id:** the ID of the custom language model to use for transcription. If not specified, the general
  language model is used.
- **events:** a string that specifies the type of events to send to a return URL. If not specified, no events will be
  sent.
- **inactivity_timeout:** the time (in seconds) that must elapse with no audio input activity before the transcription
  session is closed. If not specified, the default value of 30 seconds is used.
- **interim_results:** a boolean value indicating whether to return intermediate transcription results (interim results
  before final transcription).
- **keywords:** an array of keywords to search for in the transcript. If a keyword is found, an event can be sent to a
  return URL.
- **keywords_threshold:** the minimum level of confidence that must be had for a keyword to be considered as found. If
  not specified, the default value of 0.5 is used.
- **language_customization_id:** the ID of the custom language model to use for language detection. If not specified,
  the general language detection model is used.
- **max_alternatives:** the maximum number of transcription alternatives to return. If not specified, the default value
  of 1 is used.
- **model:** the ID of the language model to use for transcription. If not specified, the general language model is
  used.
- **profanity_filter:** a boolean value indicating whether to redact offensive content in the transcript.
- **smart_formatting:** a boolean value indicating whether to add punctuation marks and capitalization corrections to
  the transcript.
- **speaker_labels:** a boolean value indicating whether to identify and label the speakers in the transcript.
- **timestamps:** a boolean value indicating whether to include timestamps in the transcript.
- **word_alternatives_threshold:** the minimum level of confidence that must be had for a word to be considered as found
  in a transcription alternative. If not specified, the default value of 0.1 is used.
- **word_confidence:** a boolean value indicating whether to return the confidence levels of individual words in the
  transcript.

**Response:**
The transcript text in the requested format.

## Running Tests

**1. To run the tests for the IBM Cloud services implemented in this project, follow the steps below:**

* Clone the repository to your local machine.
* Install the necessary dependencies by running composer install.
* Create a .env or .yaml (in case of yaml you must respect the name (**ibm-cloud.yaml**) file in the root directory of
  the project, and add environment variables

**2. Run the tests for all services using the following command:**

```
vendor/bin/phpunit ./tests
```

**3. Replace ServiceName with the name of the service you want to test, i.e. COS, NLU, TTS, or STT.**

```
vendor/bin/phpunit ./tests/ SERVICE / TEST_CLASS
```

This will run the tests for the IBM Cloud Object Storage service.

**4. If all tests pass, you should see a message similar to the following:**

```
OK (XX tests, XX assertions)
```

If any tests fail, you will see an error message indicating the reason for the failure.

Note: Some tests may fail if you do not have the necessary credentials or permissions to access certain resources on
your IBM Cloud account.

## Frequent questions

**How can I get IBM Cloud credentials?**

You can get IBM Cloud credentials from the IBM Cloud control panel. See the IBM Cloud documentation for more
information.

**How can I fix authentication errors?**

Make sure that the IBM Cloud credentials are correct and that they are set up correctly in the YAML or ENV file. You can
also try regenerating the credentials and reconfiguring them.

**How can I report bugs or request new features?**

You can report bugs or request new features in the SDK GitHub repository. See the "Contribute" section in the SDK
README.md file for more information.

## Contribute

If you want to contribute to the development of the SDK, you can do so in several ways:

If you find bugs or problems, you can report them on the SDK GitHub repository. If you want to request new features or
enhancements, you can also do so in the SDK GitHub repository. If you want to fix bugs or add new features, you can fork
the repository and submit a pull request with your changes.
Before committing any changes, make sure that you have created proper unit and integration tests for your changes and
that the documentation has been updated accordingly.

## Conclusion

The IBM Cloud SDK for PHP is a useful tool for interacting with IBM Cloud services from applications written in PHP.
With the proper installation and configuration instructions, end users can use the SDK to interact with IBM NLU and IBM
COS. Clear and complete documentation, along with use cases and integration tests, will help end users to use the SDK
correctly and reduce the number of support questions. Additionally, the ability to contribute to the development of the
SDK makes it a useful and flexible tool for any project that uses the IBM Cloud.

## Upcoming integrations

| Service                                         | Description                                                                                     | Status                  |
|-------------------------------------------------|-------------------------------------------------------------------------------------------------|-------------------------|
| IBM Cloud Object Storage (COS)                  | Allows users to interact with COS to store and retrieve files.                                  | :tada: Done             |
| IBM Watson Natural Language Understanding (NLU) | Allows users to analyze and understand text with NLU.                                           | :tada: Done             |
| IBM Watson Assistant                            | Add integration with IBM Watson Assistant for creating chatbots and virtual assistants          | :stopwatch: In Progress |
| IBM Watson Language Translator                  | Add integration with IBM Watson Language Translator for text translation capabilities           | :stopwatch: In Progress |
| IBM Watson Speech to Text (STT)                 | Add integration with IBM Watson Speech to Text for transcribing spoken language into text       | :tada: Done             |
| IBM Watson Text to Speech (TTS)                 | Add integration with IBM Watson Text to Speech for converting written text into spoken language | :tada: Done             |
| IBM Watson Visual Recognition                   | Add integration with IBM Watson Visual Recognition for image recognition and analysis           | :stopwatch: In Progress |
| IBM Cloud Database                              | Add integration with IBM Cloud Databases for storing and retrieving data                        | :stopwatch: In Progress |
| IBM Cloud Functions                             | Add integration with IBM Cloud Functions for serverless computing                               | :stopwatch: In Progress |
