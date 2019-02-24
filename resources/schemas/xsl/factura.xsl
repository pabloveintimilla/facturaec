<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : factura.xsl
    Author     : Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
    Description:
        Transform SRI xml format to facturaEC object
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="xml"/>
    <xsl:output omit-xml-declaration="yes" indent="yes"/>
    <xsl:template match="/">
        <factura id="comprobante" version="1.1.0">
            <!-- Move elements of parent -->
            
            <!-- infoTributaria -->
            <ambiente> 
                <xsl:value-of select="factura/infoTributaria/ambiente"/>
            </ambiente>
            <tipoEmision>
                <xsl:value-of select="factura/infoTributaria/tipoEmision"/>
            </tipoEmision>    
            <claveAcceso>
                <xsl:value-of select="factura/infoTributaria/claveAcceso"/>
            </claveAcceso>
            <estab>
                <xsl:value-of select="factura/infoTributaria/estab"/>
            </estab>            
            <codDoc>
                <xsl:value-of select="factura/infoTributaria/codDoc"/>
            </codDoc> 
            <estab>
                <xsl:value-of select="factura/infoTributaria/estab"/>
            </estab>  
            <ptoEmi>
                <xsl:value-of select="factura/infoTributaria/ptoEmi"/>
            </ptoEmi>  
            <secuencial>
                <xsl:value-of select="factura/infoTributaria/secuencial"/>
            </secuencial>              
                                    
            <!-- infoFactura -->
            <fechaEmision>
                <xsl:value-of select="factura/infoFactura/fechaEmision"/>
            </fechaEmision>  
            <propina>
                <xsl:value-of select="factura/infoFactura/propina"/>
            </propina>    
            <totalSinImpuestos>
                <xsl:value-of select="factura/infoFactura/totalSinImpuestos"/>
            </totalSinImpuestos>      
            <totalDescuento>
                <xsl:value-of select="factura/infoFactura/totalDescuento"/>
            </totalDescuento>                                                
            <importeTotal>
                <xsl:value-of select="factura/infoFactura/importeTotal"/>
            </importeTotal>               
            
            <!-- Copy other elements -->
            <xsl:copy-of select="factura/infoTributaria"/>
            <xsl:copy-of select="factura/infoFactura"/>
            <xsl:copy-of select="factura/detalles"/>
            <xsl:copy-of select="factura/infoAdicional"/>
        </factura>
    </xsl:template>
</xsl:stylesheet>
