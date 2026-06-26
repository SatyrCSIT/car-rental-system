{{-- ฟิลด์รถ ใช้ร่วมหน้าเพิ่ม/แก้ไข ($vehicle = null ตอนเพิ่ม) — กฎ 1: ไม่ซ้ำซ้อน --}}
@php($inputClass = 'w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition')

<div class="grid sm:grid-cols-2 gap-4">
    <div>
        <label for="vehicle_type_id" class="block text-sm font-medium text-slate-600 mb-1">ประเภทรถ</label>
        <select name="vehicle_type_id" id="vehicle_type_id" class="{{ $inputClass }}">
            <option value="">— เลือกประเภท —</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" @selected(old('vehicle_type_id', $vehicle?->vehicle_type_id) == $type->id)>{{ $type->name }}</option>
            @endforeach
        </select>
        @error('vehicle_type_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-slate-600 mb-1">สถานะ</label>
        <select name="status" id="status" class="{{ $inputClass }}">
            @foreach (['available' => 'ว่าง', 'rented' => 'ไม่ว่าง', 'maintenance' => 'ซ่อมบำรุง'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $vehicle?->status ?? 'available') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="brand" class="block text-sm font-medium text-slate-600 mb-1">ยี่ห้อ</label>
        <input type="text" name="brand" id="brand" value="{{ old('brand', $vehicle?->brand) }}" class="{{ $inputClass }}">
        @error('brand') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="model" class="block text-sm font-medium text-slate-600 mb-1">รุ่น</label>
        <input type="text" name="model" id="model" value="{{ old('model', $vehicle?->model) }}" class="{{ $inputClass }}">
        @error('model') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="license_plate" class="block text-sm font-medium text-slate-600 mb-1">ป้ายทะเบียน</label>
        <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate', $vehicle?->license_plate) }}" class="{{ $inputClass }}">
        @error('license_plate') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="daily_rate" class="block text-sm font-medium text-slate-600 mb-1">ราคา/วัน (บาท)</label>
        <input type="number" name="daily_rate" id="daily_rate" step="1" min="0" value="{{ old('daily_rate', $vehicle?->daily_rate) }}" class="{{ $inputClass }}">
        @error('daily_rate') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-4">
    <label for="image" class="block text-sm font-medium text-slate-600 mb-1">
        รูปรถ @if ($vehicle) <span class="text-slate-400 font-normal">(อัปโหลดใหม่เพื่อเปลี่ยน)</span> @endif
    </label>
    @if ($vehicle?->image_path)
        <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="รูปรถปัจจุบัน" class="w-40 h-28 object-cover rounded-lg mb-2 border border-slate-200">
    @endif
    <input type="file" name="image" id="image" accept="image/*"
        class="w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 file:font-medium hover:file:bg-indigo-100">
    <p class="text-xs text-slate-400 mt-1">รองรับ JPG, PNG, WEBP ขนาดไม่เกิน 2MB</p>
    @error('image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>
