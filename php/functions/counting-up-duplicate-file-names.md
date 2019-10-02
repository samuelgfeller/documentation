# Counting up function on duplicate Filenames 

```php
    /**
     * Generate filename which contains the config download path, the file name
     * which is the the video name with removed special chars and spaces replaced with hyphens ("-")
     * and in given extension in config.
     * If the file already exists a counted up number is added to the filename (video1.mp4)
     *
     * @param $originalName
     * @return string
     */

    public function createFileName($originalName): string
    {
        $fileName = str_replace(' ', '-', $originalName); // Replaces all spaces with hyphens.
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName); // Removes special chars.
        $fileName = preg_replace('/-+/', '-', $fileName); // Replaces multiple hyphens with single one.
        $fullFileName = $this->config['download_directory'] . $fileName . $this->config['video_extension']; // Set final file name with path and extension

        // https://stackoverflow.com/a/16136562/9013718
        $i = 1;
        while (file_exists($fullFileName)) {
            $fullFileName = $this->config['download_directory'] . $fileName . $i . $this->config['video_extension'];
            $i++;
        }
        return $fullFileName;
    }
```
