<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

/**
 * Interface for IBM Cloud Object Storage (COS) service.
 */
interface CloudObjectStorageInterface
{
    /**
     * Creates a new bucket in the given region.
     *
     * @param string $bucketName Name of the bucket to be created.
     * @param string|null $region Region of the bucket. If not specified, the service will choose a default region.
     *
     * @return bool The response from the service.
     */
    public function createBucket(string $bucketName, string $region = null): bool;

    /**
     * Deletes an existing bucket.
     *
     * @param string $bucketName Name of the bucket to be deleted.
     *
     * @return bool The response from the service.
     */
    public function deleteBucket(string $bucketName): bool;

    /**
     * Gets the contents of an object in the specified bucket.
     *
     * @param string $bucketName Name of the bucket.
     * @param string $objectName Name of the object to be retrieved.
     *
     * @return string The response from the service.
     */
    public function getObject(string $bucketName, string $objectName): string;

    /**
     * Copies an object to another bucket, optionally changing the object's name.
     *
     * @param string $sourceBucket Name of the source bucket.
     * @param string $sourceObject Name of the source object to be copied.
     * @param string $destinationBucket Name of the destination bucket.
     * @param string $destinationObject Name of the destination object. If not specified, the source object name is used.
     * @param string|null $contentType Content type of the object. If not specified, the service will choose a default content type.
     * @param array $metadata Optional metadata to add to the destination object.
     *
     * @return bool The response from the service.
     */
    public function copyObject(string $sourceBucket, string $sourceObject, string $destinationBucket, string $destinationObject, string $contentType = null, array $metadata = []): bool;

    /**
     * Uploads a new object to the specified bucket.
     *
     * @param string $bucketName Name of the bucket to upload to.
     * @param string $objectName Name of the object to be uploaded.
     * @param string $body The content of the object to be uploaded, either as a string or a resource.
     * @param string|null $contentType Content type of the object. If not specified, the service will choose a default content type.
     * @param array $metadata Optional metadata to add to the object.
     *
     * @return bool The response from the service.
     */
    public function putObject(string $bucketName, string $objectName, string $body, string $contentType = null, array $metadata = []): bool;

    /**
     * Deletes an object from the specified bucket.
     *
     * @param string $bucketName Name of the bucket.
     * @param string $objectName Name of the object to be deleted.
     *
     * @return bool The response from the service.
     */
    public function deleteObject(string $bucketName, string $objectName): bool;

    /**
     * Lists the objects in the specified bucket.
     *
     * @param string $bucketName Name of the bucket.
     * @param string|null $prefix Prefix used to filter the objects by key name.
     * @param string|null $delimiter Delimiter used to group keys.
     *
     * @return array The response from the service.
     */
    public function listObjects(string $bucketName, string $prefix = null, string $delimiter = null): array;

    /**
     * Lists the buckets in the service instance
     *
     * @return array Array of bucket names
     */
    public function listBuckets(): array;
}