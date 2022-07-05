# Setup Guide

1. Sign in or create an account in AWS console
- https://console.aws.amazon.com

![](docs/1.png)
![](docs/2.png)

2. Get your Secret Access Key Id and Secret Access Key, save them in the following directory
- Create a folder and a file for your AWS credentials
  - `mkdir ~/.aws/ && touch ~/.aws/credentials`
- https://console.aws.amazon.com/iam/home?region=us-east-1#/security_credentials
- https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_profiles.html


![](docs/3.png)
  
3. Run `composer install` in `/src/`.


4. Create a new folder and put files in it - much like the `folder` example. 


5. Use `createBucketService.php` service to create a bucket. Syntax: `php createBucketService.php [bucket name]`.

6. Use `uploadService.php` service to upload the folder. Syntax: `php uploadService.php [bucket name] [folder name]`.

#### Note: Be careful about `'region' => 'us-central-1',` in `src/config.php`, use the one shown when you open `https://s3.console.aws.amazon.com/s3/buckets` (like in `https://s3.console.aws.amazon.com/s3/buckets?region=eu-central-1`, the `region=eu-central-1` part)