// ============================================================
// assets/js/master-db.js
// Frontend Master DB Proxy - Replaces Supabase SDK
// ============================================================

class MasterDBQueryBuilder {
    constructor(table) {
        this.table = table;
        this.action = 'select';
        this.selectCols = '*';
        this.filters = [];
        this.orderObj = null;
        this.limitNum = null;
        this.isSingle = false;
        this.payloadData = null;
        this.headFlag = false;
        this.countType = null;
        this.rangeArr = null;
    }

    select(cols = '*', opts = {}) {
        this.action = 'select';
        this.selectCols = cols;
        if (opts && opts.head) this.headFlag = true;
        if (opts && opts.count) this.countType = opts.count;
        return this;
    }

    insert(data) { this.action = 'insert'; this.payloadData = data; return this; }
    update(data) { this.action = 'update'; this.payloadData = data; return this; }
    upsert(data) { this.action = 'upsert'; this.payloadData = data; return this; }
    delete()     { this.action = 'delete'; return this; }
    
    eq(col, val)  { this.filters.push({ method: 'eq', args: [col, val] }); return this; }
    neq(col, val) { this.filters.push({ method: 'neq', args: [col, val] }); return this; }
    lt(col, val)  { this.filters.push({ method: 'lt', args: [col, val] }); return this; }
    gt(col, val)  { this.filters.push({ method: 'gt', args: [col, val] }); return this; }
    gte(col, val) { this.filters.push({ method: 'gte', args: [col, val] }); return this; }
    lte(col, val) { this.filters.push({ method: 'lte', args: [col, val] }); return this; }
    in(col, vals) { this.filters.push({ method: 'in', args: [col, vals] }); return this; }
    like(col, val){ this.filters.push({ method: 'like', args: [col, val] }); return this; }
    
    order(col, opts = {}) { this.orderObj = { col, ascending: opts.ascending !== false }; return this; }
    limit(n)      { this.limitNum = n; return this; }
    range(from, to) { this.rangeArr = [from, to]; return this; }
    single()      { this.isSingle = true; return this; }
    maybeSingle() { this.isSingle = true; return this; }
    
    then(onFulfilled, onRejected) {
        return this.execute().then(onFulfilled, onRejected);
    }
    
    async execute() {
        const body = {
            table: this.table,
            action: this.action,
            selectCols: this.selectCols,
            filters: this.filters,
            orderObj: this.orderObj,
            limitNum: this.limitNum,
            isSingle: this.isSingle,
            payloadData: this.payloadData,
            headFlag: this.headFlag,
            countType: this.countType,
            rangeArr: this.rangeArr
        };
        
        try {
            const res = await fetch('/api/master-db', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body)
            });
            const data = await res.json();
            return data;
        } catch (err) {
            return { data: null, error: { message: err.message }, count: null };
        }
    }
}

// Global MasterDB Object
window.MasterDB = {
    from: function(table) {
        return new MasterDBQueryBuilder(table);
    },
    // We keep the original supabase auth module active so auth still works
    // Future update: abstract auth into master-db as well.
    auth: typeof sb !== 'undefined' && sb.auth ? sb.auth : null
};
