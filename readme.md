# Guide

1. Sign in to the console or create an account 
- https://console.aws.amazon.com

2. Get your Secret Access Key Id and Secret Access Key, save them
- https://console.aws.amazon.com/iam/home?region=us-east-1#/security_credentials
- https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_profiles.html
- Create a folder and a file for your credentials  
  - `mkdir ~/.aws/ && touch ~/.aws/credentials`
  - https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_profiles.html

3. Run `composer install` in `/src/`.

4. Create a new folder and put files in it - much like the `folder` example. 


5. Use `createBucketService.php` to create a bucket. Syntax: `php createBucketService.php [bucket name]`.
Note: Be careful about `'region' => 'us-central-1',` in config, use the one shown when you open `https://s3.console.aws.amazon.com/s3/buckets` [like https://s3.console.aws.amazon.com/s3/buckets?region=eu-central-1]