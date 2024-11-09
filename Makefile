build:
	php doc-base/configure.php --with-lang=ja

xhtml:
	php phd/render.php --docbook doc-base/.manual.xml --package PHP --format xhtml

open:
	@if [ -f output/php-chunked-xhtml/index.html ]; then \
		open output/php-chunked-xhtml/index.html; \
	else \
		echo "Output file not found: output/php-chunked-xhtml/index.html"; \
	fi
