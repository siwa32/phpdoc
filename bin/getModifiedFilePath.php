<?php

const LANG = 'ja';

main();

/**
 * LANG配下のgit-statusより更新されたファイルを取得し対応するHTMLファイルのパスを出力
 *
 * @return string[]
 */
function main(): void
{
    $gitStatusOutput = getGitStatusOutput(LANG);

    $modifiedFiles = array_filter(
        getModifiedFilesFromGitStatusOutput($gitStatusOutput),
        fn (string $file) => str_ends_with($file, '.xml'),
    );

    $pageIds = array_filter(array_map(
        fn (string $file) => getPageIdFromFile(LANG . '/' . $file),
        $modifiedFiles,
    ));

    $pathes = array_map(
        fn (string $id) => "output/php-chunked-xhtml/{$id}.html",
        $pageIds,
    );

    echo implode("\n", $pathes) . PHP_EOL;
}

/**
 * 指定されたパスの git-status を取得
 */
function getGitStatusOutput(string $path): string
{
    return `git -C {$path} status --porcelain=1`;
}

/**
 * git-status の出力より更新されたファイルの一覧を取得
 *
 * @return string[]
 */
function getModifiedFilesFromGitStatusOutput(string $output): array
{
    $files = [];

    foreach (explode("\n", $output) as $line) {
        $status = substr($line, 0, 2);
        $file = substr($line, 3);

        if (!in_array($status, [
            '??', // 新規の未追跡ファイル（Untracked）
            'A ', // インデックスに追加された新規ファイル（Added to index）
            'M ', // インデックスが修正されたファイル（Modified in index）
            'AM', // インデックスに追加され、ワーキングディレクトリでも変更されたファイル
            'MM', // インデックスが修正され、ワーキングディレクトリでも修正されたファイル
            'RM', // インデックスでリネームされ、ワーキングディレクトリで修正されたファイル
            'CM', // インデックスでコピーされ、ワーキングディレクトリで修正されたファイル
            ' M', // ワーキングディレクトリで変更されたファイル（Modified in working tree）
        ])) {
            continue;
        }

        $files[] = preg_match('/^\S+ -> (\S+)$/', $file, $matches)
            ? $matches[1]
            : $file;
    }

    return $files;
}

function getPageIdFromFile(string $file): ?string
{
    $xml = new XMLReader();
    $xml->open($file);

    while ($xml->nodeType !== XMLReader::ELEMENT) {
        if (!@$xml->read()) {
            return null;
        }
    }

    $id = $xml->getAttribute('xml:id');

    return $id;
}
