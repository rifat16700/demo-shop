-- ════════════════════════════════════════════════════════
-- SIMPLE FIX: Reviews & Orders — anon user সব করতে পারবে
-- এটা সহজ — admin panel কে auth লাগবে না
-- Supabase Dashboard → SQL Editor → paste → Run
-- ════════════════════════════════════════════════════════

-- ── REVIEWS ──────────────────────────────────────────

ALTER TABLE reviews ENABLE ROW LEVEL SECURITY;

-- সব পুরনো policies মুছো
DROP POLICY IF EXISTS "Allow public insert reviews"       ON reviews;
DROP POLICY IF EXISTS "Allow public read approved reviews" ON reviews;
DROP POLICY IF EXISTS "Allow admin read all reviews"       ON reviews;
DROP POLICY IF EXISTS "Allow admin update reviews"         ON reviews;
DROP POLICY IF EXISTS "Allow admin delete reviews"         ON reviews;

-- নতুন simple policies
-- যেকোনো user insert করতে পারবে (review submit)
CREATE POLICY "public_insert_reviews"
  ON reviews FOR INSERT TO anon, authenticated
  WITH CHECK (true);

-- যেকোনো user সব reviews পড়তে পারবে (admin panel সব দেখবে)
CREATE POLICY "public_select_reviews"
  ON reviews FOR SELECT TO anon, authenticated
  USING (true);

-- যেকোনো user update করতে পারবে (admin approve/reject)
CREATE POLICY "public_update_reviews"
  ON reviews FOR UPDATE TO anon, authenticated
  USING (true) WITH CHECK (true);

-- যেকোনো user delete করতে পারবে (admin delete)
CREATE POLICY "public_delete_reviews"
  ON reviews FOR DELETE TO anon, authenticated
  USING (true);


-- ── ORDERS ──────────────────────────────────────────

ALTER TABLE orders ENABLE ROW LEVEL SECURITY;

DROP POLICY IF EXISTS "Allow public insert orders"  ON orders;
DROP POLICY IF EXISTS "Allow admin read all orders"  ON orders;
DROP POLICY IF EXISTS "Allow admin update orders"    ON orders;
DROP POLICY IF EXISTS "Allow admin delete orders"    ON orders;

CREATE POLICY "public_insert_orders"
  ON orders FOR INSERT TO anon, authenticated
  WITH CHECK (true);

CREATE POLICY "public_select_orders"
  ON orders FOR SELECT TO anon, authenticated
  USING (true);

CREATE POLICY "public_update_orders"
  ON orders FOR UPDATE TO anon, authenticated
  USING (true) WITH CHECK (true);

CREATE POLICY "public_delete_orders"
  ON orders FOR DELETE TO anon, authenticated
  USING (true);


-- ── অন্যান্য tables (products, categories etc.) ──

-- products
ALTER TABLE products ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_all_products" ON products;
CREATE POLICY "public_all_products"
  ON products FOR ALL TO anon, authenticated
  USING (true) WITH CHECK (true);

-- categories
ALTER TABLE categories ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_all_categories" ON categories;
CREATE POLICY "public_all_categories"
  ON categories FOR ALL TO anon, authenticated
  USING (true) WITH CHECK (true);

-- settings
ALTER TABLE settings ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_all_settings" ON settings;
CREATE POLICY "public_all_settings"
  ON settings FOR ALL TO anon, authenticated
  USING (true) WITH CHECK (true);

-- banners
ALTER TABLE banners ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_all_banners" ON banners;
CREATE POLICY "public_all_banners"
  ON banners FOR ALL TO anon, authenticated
  USING (true) WITH CHECK (true);

-- home_sections (যদি থাকে)
DO $$ BEGIN
  IF EXISTS (SELECT FROM information_schema.tables WHERE table_name = 'home_sections') THEN
    ALTER TABLE home_sections ENABLE ROW LEVEL SECURITY;
    DROP POLICY IF EXISTS "public_all_home_sections" ON home_sections;
    CREATE POLICY "public_all_home_sections"
      ON home_sections FOR ALL TO anon, authenticated
      USING (true) WITH CHECK (true);
  END IF;
END $$;

-- product_categories
ALTER TABLE product_categories ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS "public_all_product_categories" ON product_categories;
CREATE POLICY "public_all_product_categories"
  ON product_categories FOR ALL TO anon, authenticated
  USING (true) WITH CHECK (true);

-- ════════════════════════════════════════════════════════
-- এই SQL run করার পর:
-- 1. product page এ review submit করো — কাজ করবে
-- 2. admin/reviews.html এ pending reviews দেখা যাবে
-- 3. Approve বাটন কাজ করবে
-- ════════════════════════════════════════════════════════
