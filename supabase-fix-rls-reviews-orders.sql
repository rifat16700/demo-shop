-- ════════════════════════════════════════════════════════
-- FIX: Reviews & Orders RLS Policies
-- Supabase Dashboard → SQL Editor এ paste করে Run করো
-- ════════════════════════════════════════════════════════

-- ── REVIEWS TABLE ─────────────────────────────────────

-- 1. RLS enable করো (already enabled থাকলে skip করবে)
ALTER TABLE reviews ENABLE ROW LEVEL SECURITY;

-- 2. Public INSERT — যেকোনো visitor review submit করতে পারবে
DROP POLICY IF EXISTS "Allow public insert reviews" ON reviews;
CREATE POLICY "Allow public insert reviews"
  ON reviews FOR INSERT
  WITH CHECK (true);

-- 3. Public SELECT — শুধু approved reviews দেখা যাবে
DROP POLICY IF EXISTS "Allow public read approved reviews" ON reviews;
CREATE POLICY "Allow public read approved reviews"
  ON reviews FOR SELECT
  USING (is_approved = true);

-- 4. Authenticated (Admin) SELECT — সব reviews দেখতে পারবে (pending সহ)
DROP POLICY IF EXISTS "Allow admin read all reviews" ON reviews;
CREATE POLICY "Allow admin read all reviews"
  ON reviews FOR SELECT
  TO authenticated
  USING (true);

-- 5. Authenticated (Admin) UPDATE — approve/reject করতে পারবে
DROP POLICY IF EXISTS "Allow admin update reviews" ON reviews;
CREATE POLICY "Allow admin update reviews"
  ON reviews FOR UPDATE
  TO authenticated
  USING (true)
  WITH CHECK (true);

-- 6. Authenticated (Admin) DELETE — delete করতে পারবে
DROP POLICY IF EXISTS "Allow admin delete reviews" ON reviews;
CREATE POLICY "Allow admin delete reviews"
  ON reviews FOR DELETE
  TO authenticated
  USING (true);

-- ── ORDERS TABLE ─────────────────────────────────────

ALTER TABLE orders ENABLE ROW LEVEL SECURITY;

-- Public can place orders
DROP POLICY IF EXISTS "Allow public insert orders" ON orders;
CREATE POLICY "Allow public insert orders"
  ON orders FOR INSERT
  WITH CHECK (true);

-- Admin can see all orders
DROP POLICY IF EXISTS "Allow admin read all orders" ON orders;
CREATE POLICY "Allow admin read all orders"
  ON orders FOR SELECT
  TO authenticated
  USING (true);

DROP POLICY IF EXISTS "Allow admin update orders" ON orders;
CREATE POLICY "Allow admin update orders"
  ON orders FOR UPDATE
  TO authenticated
  USING (true) WITH CHECK (true);

DROP POLICY IF EXISTS "Allow admin delete orders" ON orders;
CREATE POLICY "Allow admin delete orders"
  ON orders FOR DELETE
  TO authenticated
  USING (true);

-- ════════════════════════════════════════════════════════
-- IMPORTANT: Admin কে Supabase Auth থেকে login করাতে হবে
-- তাহলেই "authenticated" policy কাজ করবে
-- Admin panel login → admin/login.html
-- ════════════════════════════════════════════════════════
