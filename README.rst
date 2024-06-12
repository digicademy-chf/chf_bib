..  image:: https://img.shields.io/badge/PHP-8.2/8.3-blue.svg
    :alt: PHP 8.2/8.3
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-13-orange.svg
    :alt: TYPO3 13
    :target: https://get.typo3.org/version/13

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

=======
CHF Bib
=======

The extension provides a data model for bibliographic data, as part of the
Cultural Heritage Framework (CHF). It is largely modelled after the ``biblStruct``
`element in TEI XML <https://www.tei-c.org/release/doc/tei-p5-doc/en/html/ref-biblStruct.html>`__
as `produced by Zotero <https://github.com/zotero/translators/blob/master/TEI.js>`__.
In addition, entries may carry descriptions, summaries, (cover) images, and other
files to put together annotated bibliographies. The data can be listed as a full
bibliography, but entries and contributors may also be grouped via labels, and
other data models can reference and elaborate on individual entries using a
``Reference`` class. A ``SameAs`` class may be used to identify, for example,
authors via their ORCIDs in linked-data scenarios. A frontend plugin provides
options to display selections of the bibliography, and a few common
serialisations of bibliographic data are included out of the box. A TYPO3 task
can be activated to periodically and automatically import data from a Zotero
library.

:Repository:  https://github.com/digicademy-chf/chf_bib
:Read online: https://digicademy-chf.github.io/chf_bib
:TER:         https://extensions.typo3.org/extension/chf_bib

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

- Frontend plugin and templates
- Import of *Namenforschung* data
- Embedded metadata
- First set of serialisations
- Search configuration
- Generic Zotero import
- Add API documentation

**Beyond 2.0.0**

- Add testing
- Additional serialisations
