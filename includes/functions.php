<?php

/**
 * Parse the markdown file and extract quotes.
 * 
 * @param string $filename The name of the markdown file (without extension).
 * @return array Parsed quotes.
 * @throws Exception If the file is not found.
 */
function parseMarkdownFile(string $filename): array {
    $file_path = CONTENT_DIR . '/' . $filename . '.md';

    if (!file_exists($file_path)) {
        throw new Exception("File not found: $filename.md");
    }

    $content = file_get_contents($file_path);
    if ($content === false) {
        throw new Exception("Unable to read the file: $filename.md");
    }

    return parseMarkdownQuotes($content);
}

/**
 * Parse markdown content and return an array of quotes.
 * 
 * @param string $markdown The markdown content.
 * @return array Parsed quotes.
 */
function parseMarkdownQuotes(string $markdown): array {
    $quotes = [];
    $pattern = '/# (.*?)\nslug: (.*?)\ncontent: "(.*?)"/s';

    if (preg_match_all($pattern, $markdown, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {

            $quotes[] = [
                'title' => escapeHtml($match[1]),
                'slug' => escapeHtml($match[2]),
                'content' => escapeHtml($match[3])
            ];
        }
    }

    return $quotes;
}

/**
 * Get quotes for a specific page, with pagination.
 * 
 * @param int $page The page number to retrieve.
 * @return array Paginated quotes.
 * @throws Exception If there is an issue retrieving quotes.
 */
function getQuotesForPage(int $page = 1): array {
    try {
        $quotes = parseMarkdownFile('quotes');
        $offset = ($page - 1) * ITEMS_PER_PAGE;
        return array_slice($quotes, $offset, ITEMS_PER_PAGE);
    } catch (Exception $e) {
 
        throw new Exception("Error fetching quotes for page $page: " . $e->getMessage());
    }
}

/**
 * Get the total number of pages based on the total number of quotes.
 * 
 * @return int The total number of pages.
 */
function getTotalPages(): int {
    try {
        $quotes = parseMarkdownFile('quotes');
        return ceil(count($quotes) / ITEMS_PER_PAGE);
    } catch (Exception $e) {

        throw new Exception("Error calculating total pages: " . $e->getMessage());
    }
}

/**
 * Get a single quote by its slug.
 * 
 * @param string $slug The slug of the quote.
 * @return array|null The quote or null if not found.
 */
function getQuoteBySlug(string $slug): ?array {
    try {
        $quotes = parseMarkdownFile('quotes');
        foreach ($quotes as $quote) {
            if ($quote['slug'] === $slug) {
                return $quote;
            }
        }
        return null;
    } catch (Exception $e) {
 
        throw new Exception("Error fetching quote by slug '$slug': " . $e->getMessage());
    }
}

/**
 * Validate the page number (must be an integer greater than 0).
 * 
 * @param mixed $page The page number to validate.
 * @return int The validated page number.
 */
function validatePage($page): int {
    $validatedPage = filter_var($page, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    return $validatedPage ? $validatedPage : 1;
}

/**
 * Escape output to prevent XSS.
 * 
 * @param string $string The string to escape.
 * @return string The escaped string.
 */
function escapeHtml(string $string): string {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
