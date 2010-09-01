<?php

/**
 * Represents a generic media object, which can be a file that lives
 * anywhere and is commonly fed by the database model ioMedia.
 *
 * To override any methods in this base class, copy the ioMediaObject
 * class into your project and add the override methods there.
 *
 * @author Ryan Weaver <ryan.weaver@iostudio.com> 
 */
abstract class BaseioMediaObject
{
  /**
   * @var string The web path to the media
   * @var string The absolute path to the media
   */
  protected
    $_relativePath,
    $_rootPath;

  /**
   * Class constructor
   *
   * @param string $path The relative filepath to the asset (relative to the configured root_dir)
   *                     (e.g. my_file.jpg for SF_ROOT_DIR/web/uploads/my_file.jpg)
   *
   * @return void
   */
  public function __construct($path)
  {
    $this->_relativePath = $path;
    $this->_rootPath = sfConfig::get('sf_web_dir').'/'.sfConfig::get('app_io_media_root_dir', 'uploads').'/'.$path;

    if (!file_exists($this->_rootPath))
    {
      throw new sfException(sprintf('Cannot find asset file at "%s"', $this->_rootPath));
    }
  }
}