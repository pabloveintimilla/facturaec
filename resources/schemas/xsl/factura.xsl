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
            <ambiente>
                <xsl:value-of select="factura/infoTributaria/ambiente"/>
            </ambiente>
            <tipoEmision>
                <xsl:value-of select="factura/infoTributaria/tipoEmision"/>
            </tipoEmision>    
            <claveAcceso>
                <xsl:value-of select="factura/infoTributaria/claveAcceso"/>
            </claveAcceso>
            <codDoc>
                <xsl:value-of select="factura/infoTributaria/codDoc"/>
            </codDoc>
            <fechaEmision>
                <xsl:value-of select="factura/infoFactura/fechaEmision"/>
            </fechaEmision>             
            
            <!-- Copy other elements -->
            <xsl:copy-of select="factura/infoTributaria"/>
            <xsl:copy-of select="factura/infoFactura"/>
            <xsl:copy-of select="factura/detalles"/>
            <xsl:copy-of select="factura/infoAdicional"/>
        </factura>
    </xsl:template>
</xsl:stylesheet>
