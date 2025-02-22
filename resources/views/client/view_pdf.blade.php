<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <script src="{{ asset('assets/js/tailwind34.js') }}"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #pdf-viewer {
            width: 100%;
            margin: auto;
            border: 1px solid #ccc;
            background-color: gray;
            height: 100vh;
            overflow: auto;
        }
        canvas {
            display: block;
            max-width: 100%;
            margin: 4px auto;
        }
        .loading-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .loading-indicator.hidden {
            display: none;
        }
        .page-container {
            position: relative;
        }
        .page-loading-indicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }
    </style>
</head>
<body>
    <div class="flex flex-col items-center bg-gray-100 shadow">
        <header id="toolbar" class="flex items-center justify-between w-full p-2 text-white bg-gray-800">
            <div id="back-btn" class="flex items-center gap-2">
                <a class="p-2 border" href="{{ url()->previous() }}">Back</a>
                <div id="loading-indicator" class="loading-indicator animate-pulse">
                    <img class="w-6 h-6 animate-spin" src="{{ asset('assets/images/reload.png') }}" alt="">
                    loading...
                </div>
            </div>
            <span id="page-info">Page 1/1</span>
        </header>
        <main id="pdf-viewer" class="relative px-1 overflow-auto h-5/6"></main>
    </div>

    <script src="{{ asset('assets/js/pdf.js') }}"></script>
    <script>
        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = '{{ asset('assets/js/pdf-worker.js') }}';

        const pdfViewerContainer = document.getElementById('pdf-viewer');
        const pageInfo = document.getElementById('page-info');
        const loadingIndicator = document.getElementById('loading-indicator');

        let pdfDoc = null;
        let scale = 1.5;
        let renderedPages = new Map();

        const pdfUrl = "{{ route('pdf.stream', ['archive' => $archive, 'id' => $id, 'file_name' => $file_name]) }}";
        openPdf(pdfUrl);

        function openPdf(url) {
            showLoadingIndicator();
            pdfjsLib.getDocument(url).promise.then(pdf => {
                pdfDoc = pdf;
                pageInfo.textContent = `Page 1/${pdfDoc.numPages}`;
                renderVisiblePages().then(hideLoadingIndicator);
            }).catch(error => {
                console.error('Error loading PDF: ', error);
                hideLoadingIndicator();
            });
        }

        function renderPage(pageNumber) {
            if (renderedPages.has(pageNumber)) {
                return Promise.resolve();
            }
            return pdfDoc.getPage(pageNumber).then(page => {
                const viewport = page.getViewport({ scale });
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                canvas.setAttribute('data-page-number', pageNumber);

                const pageContainer = document.createElement('div');
                pageContainer.classList.add('page-container');
                pageContainer.appendChild(canvas);

                const pageLoadingIndicator = document.createElement('div');
                pageLoadingIndicator.classList.add('page-loading-indicator');
                pageLoadingIndicator.textContent = 'Loading...';
                pageContainer.appendChild(pageLoadingIndicator);

                pdfViewerContainer.appendChild(pageContainer);

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                pageLoadingIndicator.style.display = 'block';
                return page.render(renderContext).promise.then(() => {
                    console.log('Page rendered', pageNumber);
                    pageLoadingIndicator.style.display = 'none';
                    renderedPages.set(pageNumber, canvas);
                });
            });
        }

        function renderVisiblePages() {
            const scrollTop = pdfViewerContainer.scrollTop;
            const containerHeight = pdfViewerContainer.clientHeight;
            const startPage = Math.floor(scrollTop / (containerHeight / pdfDoc.numPages)) + 1;
            const endPage = Math.min(pdfDoc.numPages, startPage + 3);

            const promises = [];
            for (let pageNumber = startPage; pageNumber <= endPage; pageNumber++) {
                promises.push(renderPage(pageNumber));
            }
            return Promise.all(promises).then(() => {
                console.log('Visible pages rendered');
            });
        }

        function updatePageInfo() {
            const scrollTop = pdfViewerContainer.scrollTop;
            const pageHeight = pdfViewerContainer.querySelector('canvas').clientHeight;
            const pageNumber = Math.floor(scrollTop / pageHeight) + 1;
            pageInfo.textContent = `Page ${pageNumber}/${pdfDoc.numPages}`;
        }

        function showLoadingIndicator() {
            loadingIndicator.classList.remove('hidden');
        }

        function hideLoadingIndicator() {
            loadingIndicator.classList.add('hidden');
        }

        pdfViewerContainer.addEventListener('scroll', () => {
            updatePageInfo();
            renderVisiblePages();
        });
    </script>
</body>
</html>
