<?php

declare( strict_types = 1 );
namespace WaughJ\File
{
	use WaughJ\Directory\Directory;

	class File
	{
		public function __construct( string $filename, $extension = null, $directory = null )
		{
			$this->filename = $filename;
			$this->extension = ( $extension ) ? ( string )( $extension ) : '';
			if ( !$directory )
			{
				$directory = '/';
			}
			$this->directory = new Directory( $directory );
		}

		public function __toString()
		{
			return $this->getFullFilename();
		}

		public function getFullFilename() : string
		{
			return $this->directory->getString() . $this->getLocalFilename();
		}

		public function getLocalFilename() : string
		{
			return ( $this->extension ) ? $this->filename . '.' . $this->extension : $this->filename;
		}

		public function getBaseFilename() : string
		{
			return $this->filename;
		}

		public function getExtension()
		{
			return $this->extension;
		}

		public function getDirectory() : Directory
		{
			return $this->directory;
		}

		public function changeFilename( string $new_filename ) : File
		{
			return new File( $new_filename, $this->extension, $this->directory );
		}

		public function changeExtension( $new_extension ) : File
		{
			return new File( $this->filename, $new_extension, $this->directory );
		}

		public function changeDirectory( $new_directory ) : File
		{
			return new File( $this->filename, $this->extension, $new_directory );
		}

		private $filename;
		private $extension;
		private $directory;
	}
}
