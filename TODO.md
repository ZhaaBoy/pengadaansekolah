# Stock Management Implementation

## Steps to Complete
- [ ] Add 'stok' column to barangs table via migration
- [ ] Update Barang model fillable to include 'stok'
- [ ] Update VendorController store method to handle stock input
- [ ] Update VendorController update method to handle stock input
- [ ] Update PengadaanController create to show only barangs with stok > 0
- [ ] Update PengadaanController store to check stok >= qty, reject if not
- [ ] Update VendorController terima to decrement stok by qty after approval
