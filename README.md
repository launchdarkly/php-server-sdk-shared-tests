# LaunchDarkly Server-Side PHP SDK Shared Test Code

[![Run CI](https://github.com/launchdarkly/php-server-sdk-shared-tests/actions/workflows/ci.yml/badge.svg)](https://github.com/launchdarkly/php-server-sdk-shared-tests/actions/workflows/ci.yml)

This project provides support code for testing LaunchDarkly PHP SDK integrations. Feature store implementations, etc., should use this code whenever possible to ensure consistent test coverage and avoid repetition. An example of a project using this code is [php-server-sdk-redis](https://github.com/launchdarkly/php-server-sdk-redis).

The code is not published to Packagist, since it isn't of any use in any non-test context. Instead, it's meant to be used as a git repository source.

In your project that uses the shared tests, add this to `composer.json`:

```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/launchdarkly/php-server-sdk-shared-tests"
        },
    ],
```

And add this dependency:

```json
    "launchdarkly/server-sdk-shared-tests": "dev-main"
```
