module.exports = {
  devServer: {
    proxy: {
      '^/api': {
        target: 'http://127.0.0.1:8000',
        ws: true,
        changeOrigin: true
      }
    }
  },
  lintOnSave: false,
  runtimeCompiler: true,
  publicPath: 'admin/compiled',
  outputDir: '../compiled',
  indexPath: '../../../resources/views/index.blade.php'
}
