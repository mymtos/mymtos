# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

package MT::BackupRestore::ManifestFileHandler;

use strict;
use XML::SAX::Base;

@MT::BackupRestore::ManifestFileHandler::ISA = qw(XML::SAX::Base);

sub new {
    my $class   = shift;
    my (%param) = @_;
    my $self    = bless \%param, $class;
    return $self;
}

sub start_document {
    my $self = shift;
    my $data = shift;

    $self->{start} = 1;

    my $backups = {
        files  => [],
        assets => [],
    };

    $self->{backups} = $backups;

    1;
}

sub start_element {
    my $self = shift;
    my $data = shift;

    my $name  = $data->{LocalName};
    my %attrs = map {
        $data->{Attributes}->{$_}->{LocalName} =>
            $data->{Attributes}->{$_}->{Value}
    } keys( %{ $data->{Attributes} } );
    my $ns = $data->{NamespaceURI};

    if ( $self->{start} ) {
        die MT->translate(
            "The uploaded file was not a valid MyMTOS backup manifest file.")
            if !(
            ( 'manifest' eq $name )
            && (   MT::BackupRestore::NS_MOVABLETYPE() eq $ns
                || MT::BackupRestore::NS_MYMTOS() eq $ns )
            );
        $self->{start} = 0;
    }
    if (   MT::BackupRestore::NS_MOVABLETYPE() eq $ns
        || MT::BackupRestore::NS_MYMTOS() eq $ns )
    {
        my $backups = $self->{backups};
        if ( ( 'file' eq $name ) && ( 'backup' eq $attrs{type} ) ) {
            push @{ $backups->{files} }, $attrs{name};
        }
        elsif ( ( 'file' eq $name ) && ( 'asset' eq $attrs{type} ) ) {
            push @{ $backups->{assets} },
                {
                name     => $attrs{name},
                asset_id => $attrs{'asset_id'},
                };
        }
        $self->{backups} = $backups;
    }
    1;
}

sub characters {
    my $self = shift;
    my $data = shift;
    1;
}

sub end_element {
    my $self = shift;
    my $data = shift;
    1;
}

1;
