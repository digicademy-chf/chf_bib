# DA Bib

- Description: Provide bibliographies for research data in TYPO3
- Author: Jonatan Jalle Steller ([jonatan.steller@adwmainz.de](mailto:jonatan.steller@adwmainz.de))
- Requirements: TYPO3 12
- License: GPL 3
- Version: 0.0.2

The extension provides a data model for bibliographic data. It is modelled after the [`biblStruct` element in TEI XML](https://www.tei-c.org/release/doc/tei-p5-doc/en/html/ref-biblStruct.html) as [produced by Zotero](https://github.com/zotero/translators/blob/master/TEI.js). The data can be listed as a bibliography, entries and contributors can be grouped via labels, and other data models can reference and elaborate on individual entries using the `EntryRelation` class. A flexible `SameAs` class adds options to identify, for example, authors via their OrcIDs in linked-data scenarios. A frontend plugin provides options to display selections of the bibliography, and a few common serialisations of bibliographic data are included out of the box. A TYPO3 task can be activated to periodically and automatically import data from a Zotero library.

## Setup

## Usage

## Development

WIP note: use a data folder and add just one bibliographic resource along with all the other records you want to connect to that resource. You need an individual data folder for each bibliographic resource. Then add standard tags somehow, or maybe a wizard could help to add standard tags? The relevance of the right page ID (PID) for `EntryRelation`s still needs to be figured out.

## Data model

![Data model of DA Bib, drawn using draw.io](Documentation/datamodel.png)

## Roadmap

- Basic implementation
- Optimise TCA for manual input
- Test and enhance the Extbase model and use in Fluid
- Add the frontend plugin
- Add generic serialisations such as TEI, BibTEX and JSON
- Implement the Zotero import
- Finish documentation
