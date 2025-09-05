<?php

namespace App\Livewire;

use App\Exports\ReportExport;
use App\Models\DeliveryOrder;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel; // 


class ReportLivewire extends Component
{
    public $start_date = '', $end_date = '';
    public $btn_export = false;
    public $reports;
    public function mount()
    {
        $this->getReport();
    }

    public function getReport()
    {
        $start = Carbon::parse($this->start_date)->startOfDay();
        $end   = Carbon::parse($this->end_date)->endOfDay();
        if ($this->start_date && $this->end_date) {
            $this->reports = DeliveryOrder::with(['driver', 'items', 'warehouse'])
                ->orderByRaw("CASE 
            WHEN status = 'picked_up' THEN 1
            WHEN status = 'in_transit' THEN 2
            WHEN status = 'assigned' THEN 3
        WHEN status = 'delivered' THEN 4
        ELSE 5 END")
                ->whereBetween('created_at', [$start, $end])
                ->get();

            $this->dispatch('reinitComponents');
            $this->btn_export = true;
        } else {
            $this->reports = DeliveryOrder::with(['driver', 'items', 'warehouse'])
                ->orderByRaw("CASE 
            WHEN status = 'picked_up' THEN 1
            WHEN status = 'in_transit' THEN 2
            WHEN status = 'assigned' THEN 3
            WHEN status = 'delivered' THEN 4
            ELSE 5 END")
                ->orderBy('created_at', 'desc')
                ->limit(10)->get();

            $this->dispatch('reinitComponents');
        }
    }

    public function export()
    {
        $filters = [
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
        ];

        return Excel::download(new ReportExport($filters), 'report' . $this->start_date . '-' . $this->end_date . '.xlsx');
        
        $this->btn_export = false;
    }

    public function render()
    {
        return view('pages.report')->layout('components.app');
    }
}
