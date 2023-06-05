# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.4.0] - 2022-01-03
### Changed
- Multi-Language "Terms of Service" files are served using Apache Configuration only :
```
    <Directory /var/www/html/files>
        Options -Indexes +FollowSymLinks +MultiViews
        MultiviewsMatch Any
    </Directory>
```

## [0.3.1] - 2022-12-09
### Changed
- New "Disallow" rule in `robots.txt` in case backup files are indexable.

## [0.3.0] - 2021-12-08
### Added
- Backup scripts

## [0.2.0] - 2021-12-03
### Added
- Payments are now handled by an external gateway.

### Security
- Switched to SHA3-512 for transactions signatures.

## [0.1.0] - 2021-11-10
### Added
- Initial release.


