/**
 * Main application controller
 *
 * You can use this controller for your whole app if it is small
 * or you can have separate controllers for each logical section
 * 
 */
;(function() {

  angular
    .module('HMZAdminApp')
    .controller('AnalyticsCoppelController', AnalyticsCoppelController);

  AnalyticsCoppelController.$inject = ['site.config','QueryService','$rootScope','$timeout','$location','moment', '$timeout', '$http'];


  function AnalyticsCoppelController(SiteConfig, QueryService, $rootScope, $timeout, $location, moment, $timeout, $http) {

    // 'controller as' syntax
    var self = this;
    self.comments = [];
    self.showInputFile = true;
   	self.finishProccess = false;
   	self.headerSentences = [];

		self.analizeFiles = () => {


			let inputFiles = $('#uploaded_file').prop('files');

			if(inputFiles.length == 0){ //No hay archivos cargados
				return;
			}

			$(".main-wrapper .pushable").addClass("loading");
			self.showInputFile = false;

			self.readText(0,inputFiles);

		}

		self.readText = (index, inputFiles) =>{

			let file = new FileReader();
				
				file.onload = () => {
					if(!file.result){
						self.proceedComment(index, inputFiles);
						return;
					}

          let coment = {};

          coment.text = file.result;
          coment.index = index;

          let req = {
						 method: 'POST',
						 url: 'https://sentim-api.herokuapp.com/api/v1/',
						 headers: {
						   Accept: "application/json", 
							"Content-Type": "application/json"
						 },
						 data: { "text": coment.text }
					}


					$http(req).then(
						function(res){
							coment.status = 'ok';
							coment.data = res.data;
							self.comments.push(coment);
							self.proceedComment(index, inputFiles);
						}, 
						function(res){
							console.error('error',res);
							coment.status = 'error';
							coment.data = {};
							self.comments.push(coment);
							self.proceedComment(index, inputFiles);
					});

        }

				file.readAsText(inputFiles[index]);
		}

		self.proceedComment = (index, inputFiles) =>{
			if(inputFiles[index + 1]){
          	$timeout(()=>{
          		self.readText((index + 1), inputFiles);
          	}, 300);
          	
      } else {
      	$(".main-wrapper .pushable").removeClass("loading");

      	let maxSentences = Math.max(...self.comments.map(o => o.data.sentences.length));

      	for(let j=0;j<maxSentences;j++){
      		self.headerSentences.push({
      			title : `Sentence ${j + 1}`,
      			indx : j
      		})
      	}

      	self.finishProccess = true;
      	
      	$timeout(()=>{
      		$('#results_table').DataTable();
      	}, 500)
      	
      	
      }
		}

		self.newAnalytics = () =>{
			self.comments = [];
			self.showInputFile = true;
			self.finishProccess = false;
			self.headerSentences = [];
		}

		self.downloadReport = () =>{
			let fechaActual = new Date();
			$(".main-wrapper .pushable").addClass("loading");
			var wb = XLSX.utils.book_new();

			wb.Props = {
				Title: "Coppel commentss",
				Subject: "Comment analytics",
				Author: "Coppel",
				CreatedDate: fechaActual
			};

			let ws1 = XLSX.utils.table_to_sheet(document.getElementById('results_table'));
			XLSX.utils.book_append_sheet(wb, ws1, "Comentarios");

			var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});

			function s2ab(s) { 
				var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
				var view = new Uint8Array(buf);  //create uint8array as viewer
				for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
				return buf;    
			}

			saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), `Reporte_Comentarios_${moment(fechaActual).format('YYYY-MM-DD_HH-mm-ss')}.xlsx`);

			$(".main-wrapper .pushable").removeClass("loading");
		}
				
  }


})();