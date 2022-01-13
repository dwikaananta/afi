<div class="text-center mt-5 no-print" id="print">
    <button onclick="
        let print = document.getElementById('print');
        print.classList.add('d-none');
        window.print()
        print.classList.remove('d-none');
    ">Print</button>
</div>
