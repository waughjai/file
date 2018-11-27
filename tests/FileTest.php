<?php

use PHPUnit\Framework\TestCase;
use WaughJ\File\File;
use WaughJ\Directory\Directory;

class FileTest extends TestCase
{
	public function testFileString()
	{
		$file = new File( 'readme', 'txt', new Directory( '/home/media/waughj/Documents' ) );
		$this->assertEquals( ( string )( $file ), '/home/media/waughj/Documents/readme.txt' );
	}

	public function testFileLocal()
	{
		$file = new File( 'run', 'exe', new Directory( 'C:\Program Files\Game' ) );
		$this->assertEquals( $file->getLocalFilename(), 'run.exe' );
		$file2 = new File( '.gitignore', null, new Directory( '/var/www/html/website' ) );
		$this->assertEquals( $file2->getLocalFilename(), '.gitignore' );
	}

	public function testExtension()
	{
		$file = new File( 'run', 'exe', new Directory( 'C:\Program Files\Game' ) );
		$this->assertEquals( $file->getExtension(), 'exe' );
	}

	public function testDirectory()
	{
		$file = new File( '.gitignore', null, new Directory( '/var/www/html/website' ) );
		$this->assertEquals( $file->getDirectory(), new Directory(['var','www','html','website']) );
	}

	public function testFilenameChange()
	{
		$file = new File( 'october', 'doc', new Directory( '/home/media/waughj/Documents' ) );
		$file2 = $file->changeFilename( 'november' );
		$this->assertEquals( ( string )( $file2 ), '/home/media/waughj/Documents/november.doc' );
		// Original file remains unchanged.
		$this->assertEquals( ( string )( $file ), '/home/media/waughj/Documents/october.doc' );
	}

	public function testExtensionChange()
	{
		$file = new File( 'october', 'doc', new Directory( '/home/media/waughj/Documents' ) );
		$file2 = $file->changeExtension( 'odt' );
		$this->assertEquals( ( string )( $file2 ), '/home/media/waughj/Documents/october.odt' );
		// Original file remains unchanged.
		$this->assertEquals( ( string )( $file ), '/home/media/waughj/Documents/october.doc' );
	}

	public function testDirectoryChange()
	{
		$file = new File( 'october', 'doc', new Directory( '/home/media/waughj/Documents' ) );
		$file2 = $file->changeDirectory( '/home/media/jaimeson/' );
		$this->assertEquals( ( string )( $file2 ), '/home/media/jaimeson/october.doc' );
		// Original file remains unchanged.
		$this->assertEquals( ( string )( $file ), '/home/media/waughj/Documents/october.doc' );
	}
}
