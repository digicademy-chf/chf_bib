..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

All records of a bibliography are held together by a single
``BibliographicResource`` which holds the main classes ``BibliographicEntry``,
``Agent``, and ``Tag``. The class ``BibliographicEntry`` has a set of fields
that contain inforomation of non-independent items (e.g. papers in a journal)
as well as independent publications (e.g. the journal itself). Entries may be
connected to other data models, which may specify elaborations such as the
specific page number of a citation, by using the class ``SourceRelation``.

``Extent``s may be used several times in a bibliographic entry to provide, for
example, volume and number of the journal an article is published in. The same
class is used to enable providing multiple identifiers. ``Agents`` use their
own class because they may occur multiple times per publication, and their
role (e.g., author or editor) can be specified by being added via an
``AuthorshipRelation``.

In addition, the model knows flexible ``LabelTag``s and ``SameAs`` classes,
which can be used to group entries and agents via labels and to connect
entities to authority files.

..  _graphical-overview:

Graphical overview
==================

..  figure:: /DataModel/DataModel.png
    :alt: Data model of the extension
    :target: /DataModel/DataModel.png
    :class: with-shadow

    Overview of the extension's data model. Check the :ref:`api-reference`
    for further details.
