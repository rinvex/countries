# Contribution Guide

This project adheres to the following standards and practices.


## Versioning

This project is versioned under the [Semantic Versioning](http://semver.org/) guidelines as much as possible.

Releases will be numbered with the following format:

- `<major>.<minor>.<patch>`
- `<breaking>.<feature>.<fix>`

And constructed with the following guidelines:

- Breaking backward compatibility bumps the major and resets the minor and patch.
- New additions without breaking backward compatibility bumps the minor and resets the patch.
- Bug fixes and misc changes bumps the patch.


## Support Policy

- This package adheres to the following release cycle:
  - LTS Releases:
    - Released Every 2 years
    - Gets 2 years bug fixes
    - Gets 3 years security fixes
  - General Releases:
    - Released Every 6 months
    - Gets 6 months bug fixes
    - Gets 12 months security fixes
- As of next Laravel LTS release, long term support (LTS) will be provided for this package. This support and maintenance window is the largest ever provided for Rinvex packages and provides stability and peace of mind for larger, enterprise clients and customers.


## Coding Standards

This project follows the FIG PHP Standards Recommendations compliant with the [PSR-1: Basic Coding Standard](http://www.php-fig.org/psr/psr-1/), [PSR-2: Coding Style Guide](http://www.php-fig.org/psr/psr-2/) and [PSR-4: Autoloader](http://www.php-fig.org/psr/psr-4/) to ensure a high level of interoperability between shared PHP code. If you notice any compliance oversights, please send a patch via pull request.


## Pull Requests

The pull request process differs for new features and bugs.

Pull requests for bugs may be sent without creating any proposal issue. If you believe that you know of a solution for a bug that has been filed, please leave a comment detailing your proposed fix or create a pull request with the fix mentioning that issue id.


## Proposal / Feature Requests

If you have a proposal or a feature request, you may create an issue with `[Proposal]` in the title.

The proposal should also describe the new feature, as well as implementation ideas. The proposal will then be reviewed and either approved or denied. Once a proposal is approved, a pull request may be created implementing the new feature.


### Which Branch?

This project follows [Git-Flow](http://nvie.com/posts/a-successful-git-branching-model/), and as such has `master` (latest stable releases), `develop` (latest WIP development) and X.Y support branches (when there's multiple major versions).

Accordingly all pull requests MUST be sent to the `develop` branch.

> **Note:** Pull requests which do not follow these guidelines will be closed without any further notice.
