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
    </style>
</head>
<body>
    <div class="flex flex-col items-center bg-gray-100 shadow">
        <header id="toolbar" class="flex items-center justify-between w-full p-2 text-white bg-gray-800">
            <div id="back-btn" class="flex items-center gap-2">
                <a class="p-2 border" href="{{ url()->previous() }}">Back</a>
                {{-- Start Loading Indicator File --}}
                <div id="loading-indicator" class="loading-indicator animate-pulse">
                    <img class="w-6 h-6 animate-spin" src="{{ asset('assets/images/reload.png') }}" alt="">
                    loading...
                </div>
                {{-- End Loading Indicator File --}}
            </div>
            <span id="page-info">Page 1/1</span>
            {{-- <div>
                <button id="zoom-out" class="px-4 py-2 bg-gray-700 hover:bg-gray-600">- Zoom Out</button>
                <button id="zoom-in" class="px-4 py-2 bg-gray-700 hover:bg-gray-600">+ Zoom In</button>
            </div> --}}
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
        let currentScrollOffset = 0;

        // document.getElementById('zoom-in').addEventListener('click', onZoomIn);
        // document.getElementById('zoom-out').addEventListener('click', onZoomOut);

        const pdfUrl = "{{ route('pdf.stream', ['archive' => $archive, 'id' => $id, 'file_name' => $file_name]) }}";
        // const pdfUrl = "https://www.aeee.in/wp-content/uploads/2020/08/Sample-pdf.pdf";
        openPdf(pdfUrl);

        function openPdf(url) {
            showLoadingIndicator();
            pdfjsLib.getDocument(url).promise.then(pdf => {
                pdfDoc = pdf;
                pageInfo.textContent = `Page 1/${pdfDoc.numPages}`;
                renderPages().then(hideLoadingIndicator);
            }).catch(error => {
                console.error('Error loading PDF: ', error);
                hideLoadingIndicator();
            });
        }

        function renderPage(page, pageNumber) {
            const viewport = page.getViewport({ scale });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            canvas.setAttribute('data-page-number', pageNumber);

            pdfViewerContainer.appendChild(canvas);

            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            return page.render(renderContext).promise.then(() => {
                console.log('Page rendered', pageNumber);
            });
        }

        function renderPages() {
            pdfViewerContainer.innerHTML = '';
            const promises = [];
            for (let pageNumber = 1; pageNumber <= pdfDoc.numPages; pageNumber++) {
                promises.push(pdfDoc.getPage(pageNumber).then(page => renderPage(page, pageNumber)));
            }
            return Promise.all(promises).then(() => {
                console.log('All pages rendered');
            });
        }

        function onZoomIn() {
            currentScrollOffset = pdfViewerContainer.scrollTop / pdfViewerContainer.scrollHeight;
            scale += 0.25;
            renderPages().then(restoreScrollPosition);
        }

        function onZoomOut() {
            if (scale <= 0.5) {
                return;
            }
            currentScrollOffset = pdfViewerContainer.scrollTop / pdfViewerContainer.scrollHeight;
            scale -= 0.25;
            renderPages().then(restoreScrollPosition);
        }

        function restoreScrollPosition() {
            pdfViewerContainer.scrollTop = currentScrollOffset * pdfViewerContainer.scrollHeight;
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

        pdfViewerContainer.addEventListener('scroll', updatePageInfo);
    </script>
</body>
</html>


